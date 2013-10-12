<?php

namespace DF\JoueurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\DomCrawler\Crawler;
use DF\JoueurBundle\Entity\JoueurClub;

class PrivateController extends Controller
{

	/**
	 * Charge l'éffectif d'un club 
	 * @param integer $id_club	Identifiant du club
	 * 
	 * @Secure(roles="ROLE_ADMIN")
	 */
	public function newEffectifAction($id_club)
	{
		$em = $this->getDoctrine()->getManager();
		$id_saison = $this->container->getParameter('saison');
		
		$club = $this->getDoctrine()->getRepository('DFEquipeBundle:Club')->find($id_club);
		$saison = $this->getDoctrine()->getRepository('DFMatchBundle:Saison')->find($id_saison);
		
		$crawler = new Crawler(file_get_contents('http://www.lfp.fr/club/'. $club->getLfpLibelle()));
		$crawler = $crawler->filter("#sfListeEffectif")->filter('.joueur');
		
		$joueursUrl = array();
		foreach ($crawler as $cr) {
			$joueur = new \DF\JoueurBundle\Entity\Joueur();
			$cr = new Crawler($cr);
			$urlJoueurLfp = $cr->filter('.infojoueur a')->attr('href');
			$joueurProv = $this->getDoctrine()->getRepository('DFJoueurBundle:Joueur')->findOneByLfpJoueurUrl($urlJoueurLfp);
			if (!is_null($joueurProv))
				continue;
			$joueur->setLfpJoueurUrl($urlJoueurLfp);
			$ficheJoueur = new Crawler(file_get_contents('http://www.lfp.fr'.$urlJoueurLfp, 'UTF-8'));
			
			$nomPrenom = explode(' ', utf8_decode($ficheJoueur->filter('#fiche')->filter('h1')->text()));
			foreach ($nomPrenom as $text) {
				if(ctype_upper($text))
					$joueur->setNom(ucwords(strtolower($text)));
				else
					$joueur->setPrenom(ucwords(strtolower($text)));
			}
			
			$infoJoueur = $ficheJoueur->filter('.infos_joueur');
			$i = 0;
			foreach ($infoJoueur->filter('dt') as $dt) {
				$dt = new Crawler($dt);
				switch (utf8_decode($dt->html())) {
					case 'Nationalité :':
						$dd = utf8_decode($infoJoueur->filter('dd')->eq($i)->text());
						$joueur->setNationalite($dd);
						break;
					case 'Né le :':
						$dd = explode(' ', utf8_decode($infoJoueur->filter('dd')->eq($i)->text()));
						var_dump( $dd);
						$date = new \DateTime();
						$date->setDate((int)$dd[3], (int)$this->_month($dd[2]), (int)$dd[1]);
						var_dump($date);
						$joueur->setDateNaissance($date);
						break;
					case 'Taille :':
						$dd = utf8_decode($infoJoueur->filter('dd')->eq($i)->text());
						$joueur->setTaille(floatval($dd)*100);
						break;
					case 'Poids :':
						$dd = utf8_decode($infoJoueur->filter('dd')->eq($i)->text());
						$joueur->setPoids(floatval($dd));
						break;
					case 'Poste :':
						break;
				}
				$i++;
			}
			$em->persist($joueur);
			$joueurClub = new JoueurClub();
			$joueurClub->setClub($club);
			$joueurClub->setSaison($saison);
			$joueurClub->setJoueur($joueur);
			$em->persist($joueurClub);
			$em->flush();
		}
	}
	
	public function selectNewEffectifAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$id_saison = $this->container->getParameter('saison');
		$id_competition = 2;
		
		$clubs = function (EntityRepository $er) use ($id_competition, $id_saison) {
    		return $er->createQueryBuilder('c')
				->join('DF\EquipeBundle\Entity\ClubCompetition', 'cc')
				->where('cc.competition = :competition')
				->andWhere('cc.saison = :saison')
				->setParameter('competition', $id_competition)
				->setParameter('saison', $id_saison);
		};
		
		$form = $this->createFormBuilder()
			->add('club', 'entity', array(
            	'class' => 'DFEquipeBundle:Club', 
            	'property' => 'nom', 
            	'multiple' => false, 
            	'query_builder' => $clubs
             ))
			->getForm();
		
		$form->handleRequest($request);
			
		if ($form->isValid()) {
			$data = $form->getData();
			$this->newEffectifAction($data['club']->getId());
		}
		else
			return $this->render('DFAdminBundle:Private:form.html.twig', array(
				'form' => $form->createView(),
				'title' => 'Choix club',
			));
	}
	
	public function showJoueurAction()
	{
		$em = $this->getDoctrine()->getManager();
		$joueurs = $this->getDoctrine()->getRepository('DFJoueurBundle:Joueur')->findAll();
		
		return $this->render('DFJoueurBundle:Private:show-joueur.html.twig', array(
			'joueurs' => $joueurs
		));
	}
	
	public function _month($month)
	{
		if($month == 'janvier')
			return '01';
		elseif($month == 'février')
			return '02';
		elseif($month == 'mars')
			return '03';
		elseif($month == 'avril')
			return '04';
		elseif($month == 'mai')
			return '05';
		elseif($month == 'juin')
			return '06';
		elseif($month == 'juillet')
			return '07';
		elseif($month == 'août')
			return '08';
		elseif($month == 'septembre')
			return '09';
		elseif($month == 'octobre')
			return '10';
		elseif($month == 'novembre')
			return '11';
		elseif($month == 'décembre')
			return '12';
	}
	
}