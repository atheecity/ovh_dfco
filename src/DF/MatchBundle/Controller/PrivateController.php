<?php

namespace DF\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\DomCrawler\Crawler;
use DF\MatchBundle\Entity\Calendrier;
use Symfony\Component\BrowserKit\Response;
use DF\MatchBundle\Entity\Matchs;
use DF\MatchBundle\Form\MatchsType;
use DF\MatchBundle\Entity\FeuilleMatch;
use DF\MatchBundle\Form\FeuilleMatchType;

class PrivateController extends Controller
{
    
	/**
	 * Liste des competitions disponible pour le club DFCO
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function listeCompetitionAction()
	{
		$id_saison = $this->container->getParameter('saison');
		$saison = $this->getDoctrine()->getRepository('DFMatchBundle:Saison')->find($id_saison);
		if (!$saison) {
			throw $this->createNotFoundException(
					'Aucune saison trouvé pour cet id: '.$id_saison
			);
		}
		
		$id_dfco = 1;
		$club = $this->getDoctrine()->getRepository('DFEquipeBundle:Club')->find($id_dfco);
		if (!$club) {
			throw $this->createNotFoundException(
					'Aucun club trouvé pour cet id: '.$id_dfco
			);
		}
		
		$competitions = $this->getDoctrine()->getRepository('DFEquipeBundle:ClubCompetition')->findBy(
			array('club' => $club, 'saison' => $saison)
		);
	
		return $this->render('DFMatchBundle:Private:listeCompetition.html.twig', array(
			'competitions' => $competitions
		));
	}
	
	/**
	 * Liste des matchs d'une compétition
	 * @param integer $id_competition
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function competitionAction($id_competition)
	{
		$id_saison = $this->container->getParameter('saison');
		$saison = $this->getDoctrine()->getRepository('DFMatchBundle:Saison')->find($id_saison);
		if (!$saison) {
			throw $this->createNotFoundException(
					'Aucune saison trouvé pour cet id: '.$id_saison
			);
		}
		
		$competition = $this->getDoctrine()->getRepository('DFMatchBundle:Competition')->find($id_competition);
		if (!$competition) {
			throw $this->createNotFoundException(
					'Aucune competition trouvé pour cet id: '.$id_saison
			);
		}
		
		$rep_match = $this->getDoctrine()->getRepository('DFMatchBundle:Matchs');
		$matchs = $rep_match->getAllMatchCompetition($competition, $saison);
		
		return $this->render('DFMatchBundle:Private:listeMatch.html.twig', array(
			'matchs' => $matchs
		));
	}
	
	public function newFeuilleMatchAction($competition_id, $match_id)
	{
		$em = $this->getDoctrine()->getManager();
		$match = $em->getRepository('DFMatchBundle:Matchs')->find($match_id);
		
		$feuilleMatch = new FeuilleMatch();
		$feuilleMatch->setMatch($match);
		
		$form = $this->createForm(new FeuilleMatchType(), $feuilleMatch, array('match' => $match));
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
				
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($feuilleMatch);
				$em->flush();
			}
				
			return $this->redirect($this->generateUrl('DFMatchBundle_competition', array('id_competition' => $competition_id)));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
				'form' => $form->createView(),
				'title' => 'Feuille de match / '.$match->getEquipeDom()->getNom().' - '.$match->getEquipeExt()->getNom()
		));
	}
	
	
	public function updateMatchAction($id_competition, $id_match)
	{
		$em = $this->getDoctrine()->getManager();
		$match = $em->getRepository('DFMatchBundle:Matchs')->find($id_match);
		
		if ($match) {
			$form = $this->createForm(new MatchsType(), $match);
					
			$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
					
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($match);
					$em->flush();
				}
					
				return $this->redirect($this->generateUrl('DFMatchBundle_competition', array('id_competition' => $id_competition)));
			}
		}
		else
			throw $this->createNotFoundException(
					'Aucun match trouvé pour cet id: '.$id_match
			);
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
				'form' => $form->createView(),
				'titleCategorie' => 'Matchs',
				'title' => 'Modifier match : ' . $match->getEquipeDom()->getNom() .'-'. $match->getEquipeExt()->getNom(),
		));
	}
	
	/**
	 * Met à jour le classement de la ligue 2
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function updateClassementLigue2Action()
	{
		$competition_id = 2;
		$saison_id = $this->container->getParameter('saison');
		
		$em = $this->getDoctrine()->getManager();
		$clubs = $em->getRepository('DFEquipeBundle:ClubCompetition')->findBy(
			array('competition' => $competition_id, 'saison' => $saison_id)
		);
		
		foreach ($clubs as $club) {
			$class = array('points' => 0, 'journee' => 0, 'victoire' => 0, 'nul' => 0, 'defaite' => 0, 'butPour' => 0, 'butContre' => 0, 'libelle' => '');
			$classementClub = $em->getRepository('DFMatchBundle:Classement')->findOneBy(
				array('club' => $club->getClub(), 'saison' => $saison_id)
			);
			$classementClub->setPoints(0);
			$matchs = $em->getRepository('DFMatchBundle:Matchs')->getMatchByClub($club, $saison_id, $competition_id);
			
			foreach ($matchs as $match) {
				if ($match->getEquipeDom() == $club->getClub()) {
					if ($match->getScoreDom() == $match->getScoreExt()) {
						$class['points'] += 1;
						$class['nul'] += 1;
					}
					else if ($match->getScoreDom() > $match->getScoreExt()) {
						$class['points'] += 3;
						$class['victoire'] += 1;
					}
					else if ($match->getScoreDom() < $match->getScoreExt()) {
						$class['points'] += 0;
						$class['defaite'] += 1;
					}
					$class['butPour'] += $match->getScoreDom();
					$class['butContre'] += $match->getScoreExt();
					$class['libelle'] = $match->getEquipeDom()->getNom();
				}
				else if ($match->getEquipeExt() == $club->getClub()) {
					if ($match->getScoreDom() == $match->getScoreExt()) {
						$class['points'] += 1;
						$class['nul'] += 1;
					}
					else if ($match->getScoreDom() > $match->getScoreExt()) {
						$class['points'] += 0;
						$class['defaite'] += 1;
					}
					else if ($match->getScoreDom() < $match->getScoreExt()) {
						$class['points'] += 3;
						$class['victoire'] += 1;
					}
					$class['butPour'] += $match->getScoreExt();
					$class['butContre'] += $match->getScoreDom();
					$class['libelle'] = $match->getEquipeExt()->getNom();
				}
				$class['journee']++;
			}
			$classementClub->setPoints($class['points']);
			$classementClub->setJournee($class['journee']);
			$classementClub->setVictoire($class['victoire']);
			$classementClub->setNul($class['nul']);
			$classementClub->setDefaite($class['defaite']);
			$classementClub->setButPour($class['butPour']);
			$classementClub->setButContre($class['butContre']);
			$classementClub->setDiff($class['butPour'] - $class['butContre']);
			$em->persist($classementClub);
		}
		$em->flush();
	}
	
	/**
	 * Créer un calendrier pour la compétition ligue2
	 * @return \Symfony\Component\BrowserKit\Response
	 * 
	 * @Secure(roles="ROLE_ADMIN")
	 */
	public function newCalendrierLigue2Action()
	{
		$em = $this->getDoctrine()->getManager();
		
		$id_saison = $this->container->getParameter('saison');
		$saison = $this->getDoctrine()->getRepository('DFMatchBundle:Saison')->find($id_saison);
		if (!$saison) {
	        throw $this->createNotFoundException(
	            'Aucune saison trouvé pour cet id: '.$id_saison
	        );
	    }
	    
	    $id_competition = 2;
	    $competition = $this->getDoctrine()->getRepository('DFMatchBundle:Competition')->find($id_competition);
	    if (!$competition) {
	    	throw $this->createNotFoundException(
	    			'Aucune competition trouvé pour cet id: '.$id_competition
	    	);
	    }
	    
	    //Ajout de la première journée
	    $calendrier = new Calendrier();
	    $calendrier->setCompetition($competition);
	    $calendrier->setLibelle('1ère journée');
	    $calendrier->setLibelleCourt('1J');
	    $calendrier->setSaison($saison);
	    $em->persist($calendrier);
	    
	    //Ajout des journée suivantes
	    $i = 2;
	    for ($i; $i<39; $i++) {
	    	$calendrier = new Calendrier();
	    	$calendrier->setCompetition($competition);
	    	$calendrier->setSaison($saison);
	    	$calendrier->setLibelle($i.'ème journée');
	    	$calendrier->setLibelleCourt($i.'J');
	    	$em->persist($calendrier);
	    }
	    
	    $em->flush();
	    
	    return new Response('true');
	}
	
	public function newMatchLigue2Action()
	{
		$url_lfp = 'http://www.lfp.fr/ligue2/competitionPluginCalendrierResultat/changeCalendrierJournee?sai=82&jour=';
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$id_saison = $this->container->getParameter('saison');
		$saison = $this->getDoctrine()->getRepository('DFMatchBundle:Saison')->find($id_saison);
		if (!$saison) {
			throw $this->createNotFoundException(
					'Aucune saison trouvé pour cet id: '.$id_saison
			);
		}
		
		$id_competition = 2;
		$competition = $this->getDoctrine()->getRepository('DFMatchBundle:Competition')->find($id_competition);
		if (!$competition) {
			throw $this->createNotFoundException(
					'Aucune competition trouvé pour cet id: '.$id_competition
			);
		}
		
		$repClubCompetition = $this->getDoctrine()->getRepository('DFEquipeBundle:ClubCompetition');
		$clubsCompetition = $repClubCompetition->findBy(
				array('competition' => $competition, 'saison' => $saison)
		);
		
		$clubs = array();
		foreach ($clubsCompetition as $clubComp) {
			$club[strtoupper($clubComp->getClub()->getNom())] = $clubComp->getClub();
		}
		
		//Boucle pour chaque journée
		$i = 1;
		for ($i; $i<39; $i++) {
			$calendrier = $this->getDoctrine()->getRepository('DFMatchBundle:Calendrier')->findOneBy(
					array('libelleCourt' => $i.'J')
			);
			
			$html = file_get_html($url_lfp.$i);
			
			$date = array();
			$j = 0;
			//Boucle pour les dates d'une journée
			foreach ($html->find('h4') as $dt) {
				$dateArray = explode(' ', trim($dt->plaintext));
				$date[$j] = new \DateTime();
				$date[$j]->setDate((int)$dateArray[3], (int)$this->_month($dateArray[2]), (int)$dateArray[1]);
				$j++;
			}
			
			$j = 0;
			//Boucle sur chaque date 
			foreach ($html->find('table') as $table) {
				//Boucle sur chaque journée
				foreach ($table->find('tr') as $cr) {
					if ($cr->find('td')) {
						$equipeDom = strtoupper(trim($cr->find('td.domicile', 0)->plaintext));
						$equipeExt = strtoupper(trim($cr->find('td.exterieur', 0)->plaintext));
						$match = new Matchs();
						$match->setCalendrier($calendrier);
						$horaire = explode(':', trim($cr->find('td.horaire', 0)->plaintext));
						if (isset($horaire[0]) && isset($horaire[1])) {
							$date[$j]->setTime($horaire[0], $horaire[1]);
						}
						else
							$date[$j]->setTime('20', '00');
						$match->setDate($date[$j]);
						$match->setEquipeDom($club[$equipeDom]);
						$match->setEquipeExt($club[$equipeExt]);
						$em->persist($match);
					}
				}
				$j++;
			}
			$em->flush();
		}
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
