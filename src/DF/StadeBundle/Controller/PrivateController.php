<?php 

namespace DF\StadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use DF\StadeBundle\Entity\Stade;
use DF\StadeBundle\Form\StadeType;

class PrivateController extends Controller
{
	
	/**
	 * Ajouter un nouveau stade
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function newStadeAction()
	{
		$stade = new Stade();
		$form = $this->createForm(new StadeType(), $stade);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
				
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($stade);
				$em->flush();
			}
				
			return $this->redirect($this->generateUrl('DFStadeBundle_listeStadeAdmin'));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
			'form' => $form->createView(),
			'title' => 'Ajouter un stade',
		));
	}
	
	/**
	 * Supprimer un stade
	 * 
	 * @param integer $id_stade Identifiant du stade
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 * 
	 * @Secure(roles="ROLE_ADMIN")
	 */
	public function deleteStadeAction($id_stade)
	{
		$em = $this->getDoctrine()->getManager();
		$stade = $em->getRepository('DFStadeBundle:Stade')->find($id_stade);
		
		if ($stade) {
			$em->remove($stade);
			$em->flush();
		}
		else
			throw $this->createNotFoundException(
					'Aucun stade trouvé pour cet id: '.$id_stade
			);
		
		return $this->redirect($this->generateUrl('DFStadeBundle_listeStadeAdmin'));
	}
	
	/**
	 * Liste des stades
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function listeStadeAdminAction()
	{
		$rep_stade = $this->getDoctrine()->getRepository('DFStadeBundle:Stade');
		
		$stades = $rep_stade->findBy(
			array(),
			array('nom' => 'ASC')
		);
		
		return $this->render('DFStadeBundle:Private:listStade.html.twig', array(
				'stades' => $stades,
		));
	}
	
	/**
	 * Mise à jour d'un stade
	 * 
	 * @param integer $id_stade Identifiant stade
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function updateStadeAdminAction($stade_id)
	{
		$em = $this->getDoctrine()->getManager();
		$stade = $em->getRepository('DFStadeBundle:Stade')->find($stade_id);
		
		if ($stade) {
			$form = $this->createForm(new StadeType(), $stade);
			
			$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
			
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($stade);
					$em->flush();
				}
			
				return $this->redirect($this->generateUrl('DFStadeBundle_listeStadeAdmin'));
			}
		}
		else
			throw $this->createNotFoundException(
					'Aucun stade trouvé pour cet id: '.$id_stade
			);
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
				'form' => $form->createView(),
				'title' => 'Modifier un stade',
		));
	}
	
}