<?php

namespace DF\EquipeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use DF\EquipeBundle\DFEquipeBundle;
use DF\EquipeBundle\Form\ClubType;
use DF\EquipeBundle\Entity\Entraineur;
use DF\EquipeBundle\Form\EntraineurType;
use DF\EquipeBundle\Entity\ClubEntraineur;
use DF\EquipeBundle\Form\NewClubEntraineurType;

class PrivateController extends Controller
{
    
	/**
	 * Liste des clubs
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function listeClubAdminAction()
	{
		$rep_club = $this->getDoctrine()->getRepository('DFEquipeBundle:Club');
		$clubs = $rep_club->findAll();
		
		return $this->render('DFEquipeBundle:Private:listEquipe.html.twig', array(
				'clubs' => $clubs,
		));
	}
	
	/**
	 * Ajouter un club
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function newClubAction()
	{
		$club = new \DF\EquipeBundle\Entity\Club();
		
		$form = $this->createForm(new ClubType(), $club);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
				
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($club);
				$em->flush();
			}
				
			return $this->redirect($this->generateUrl('DFEquipeBundle_listeClubAdmin'));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
				'form' => $form->createView(),
				'titleCategorie' => 'Equipes',
				'title' => 'Ajouter un club',
		));
	}
	
	/**
	 * Supprimer un club
	 * @param integer $id_club Identifiant du club
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 * 
	 * @Secure(roles="ROLE_ADMIN")
	 */
	public function deleteClubAction($id_club)
	{
		$em = $this->getDoctrine()->getManager();
		$club = $em->getRepository('DFEquipeBundle:Club')->find($id_club);
		
		if ($club) {
			$em->remove($club);
			$em->flush();
		}
		else
			throw $this->createNotFoundException(
					'Aucun club trouvé pour cet id: '.$id_club
			);
		
		return $this->redirect($this->generateUrl('DFEquipeBundle_listeClubAdmin'));
	}
	
	/**
	 * Modifier un club
	 * @param integer $id_club Identifiant du club
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function updateClubAction($id_club)
	{
		$em = $this->getDoctrine()->getManager();
		$club = $em->getRepository('DFEquipeBundle:Club')->find($id_club);
		
		if ($club) {
			$form = $this->createForm(new ClubType(), $club);
			
			$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
					
				if ($form->isValid()) {
					$em->persist($club);
					$em->flush();
				}
					
				return $this->redirect($this->generateUrl('DFEquipeBundle_listeClubAdmin'));
			}
		}
		else
			throw $this->createNotFoundException(
				'Aucun club trouvé pour cet id: '.$id_club
			);
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
			'form' => $form->createView(),
			'titleCategorie' => 'Equipes',
			'title' => 'Modifier club : ' . $club->getNom(),
		));
	}
	
	/**
	 * Liste des entraineurs
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function listEntraineurAdminAction()
	{
		$saison_id = $this->container->getParameter('saison');
		
		$entraineurs = $this->getDoctrine()->getRepository('DFEquipeBundle:Entraineur')->getEntraineurWithClub();
		
		return $this->render('DFEquipeBundle:Private:listEntraineur.html.twig', array(
			'entraineurs' => $entraineurs,
			'saisonId' => $saison_id
		));
	}
	
	/**
	 * Ajouter un entraineur
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function newEntraineurAction()
	{
		$entraineur = new Entraineur();
		
		$form = $this->createForm(new EntraineurType(), $entraineur);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
		
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($entraineur);
				$em->flush();
			}
		
			return $this->redirect($this->generateUrl('DFEquipeBundle_listEntraineurAdmin'));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
			'form' => $form->createView(),
			'titleCategorie' => 'Entraineurs',
			'title' => 'Ajouter un entraineur',
		));
	}
	
	public function updateEntraineurAction($entraineur_id)
	{
		$entraineur = $this->getDoctrine()->getRepository('DFEquipeBundle:Entraineur')->findOneById($entraineur_id);
		
		$form = $this->createForm(new EntraineurType(), $entraineur);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
		
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->flush();
			}
		
			return $this->redirect($this->generateUrl('DFEquipeBundle_listEntraineurAdmin'));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
				'form' => $form->createView(),
				'titleCategorie' => 'Entraineurs',
				'title' => 'Modifier entraineur : '+$entraineur->getNom()
		));
	}
	
	public function newClubEntraineurAction($entraineur_id)
	{
		$entraineur = $this->getDoctrine()->getRepository('DFEquipeBundle:Entraineur')->findOneById($entraineur_id);
		
		$saison_id = $this->container->getParameter('saison');
		$saison = $this->getDoctrine()->getRepository('DFMatchBundle:Saison')->findOneById($saison_id);
		
		$clubEntraineur = new ClubEntraineur();
		$clubEntraineur->setEntraineur($entraineur);
		$clubEntraineur->setSaison($saison);
		
		$form = $this->createForm(new NewClubEntraineurType(), $clubEntraineur);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
		
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($clubEntraineur);
				$em->flush();
			}
		
			return $this->redirect($this->generateUrl('DFEquipeBundle_listEntraineurAdmin'));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
			'form' => $form->createView(),
			'titleCategorie' => 'Entraineurs', 
			'title' => 'Ajouter club : ' . $entraineur->getNom(),
		));
	}
	
	private function getCurrentClubForEntraineur($entraineur)
	{
		$saison_id = $this->container->getParameter('saison');
		
		$clubEntraineur = $this->getDoctrine()->getRepository('DFEquipeBundle:ClubEntraineur')->getCurrentClubForEntraineur($entraineur, $saison_id);
		
		return $clubEntraineur;
	}
	
}