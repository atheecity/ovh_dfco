<?php

namespace DF\EquipeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use DF\EquipeBundle\DFEquipeBundle;
use DF\EquipeBundle\Form\ClubType;

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
			'title' => 'Modifier un club',
		));
	}
	
}