<?php

namespace DF\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DF\BreveBundle\Entity\Breve;
use DF\BreveBundle\Form\BreveType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;

class PrivateController extends Controller
{
	/**
	 * Créer une breve
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function newBreveAction()
	{
		$breve = new Breve();
		$breve->setAuthor($this->getUser());
		$breve->setDateCreation(new \DateTime());
		$breve->setIsPublish(false);
		$form = $this->createForm(new BreveType(), $breve);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			
			if ($form->isValid()) {
				$illustration = new Crawler($breve->getIllustration());
				if ($illustration->filter('img')->count() == 1)
					$breve->setIllustration($illustration->filter('img')->attr('src'));
				$em = $this->getDoctrine()->getManager();
				$em->persist($breve);
				$em->flush();
			}
			
			return $this->redirect($this->generateUrl('DFBreveBundle_listeBreveAdmin'));
		}
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
			'form' => $form->createView(),
			'titleCategorie' => 'Brèves',
			'title' => 'Ajouter une brève',
		));
	}
	
	/**
	 * Met à jour la publication d'une brève
	 * @param integer $id_breve Identifiant d'un brève
	 * @param integer $isPublish 1 si publié
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function updatePublishAction($id_breve, $isPublish)
	{
		$em = $this->getDoctrine()->getManager();
		$breve = $em->getRepository('DFBreveBundle:Breve')->find($id_breve);
		
		if ($breve) {
			$breve->setIsPublish($isPublish);
			$breve->setDatePublication(new \DateTime());
			$em = $this->getDoctrine()->getManager();
			$em->persist($breve);
			$em->flush();
			
			$reponse = 'true';
		}
		else
			$reponse = 'false';
		
		return new Response($reponse);
	}
	
	public function updatePublishSlideAction($breve_id, $isPublish)
	{
		$em = $this->getDoctrine()->getManager();
		$breve = $em->getRepository('DFBreveBundle:Breve')->find($breve_id);
		
		if ($breve) {
			$breve->setIsPublishSlide($isPublish);
				
			$em->persist($breve);
			$em->flush();
				
			$reponse = 'true';
		}
		else
			$reponse = 'false';
		
		return new Response($reponse);
	}
	
	/**
	 * Supprime une breve
	 * @param integer $id_breve Identifant breve
	 * 
	 * @Secure(roles="ROLE_ADMIN")
	 */
	public function deleteBreveAction($id_breve)
	{
		$em = $this->getDoctrine()->getManager();
		$breve = $em->getRepository('DFBreveBundle:Breve')->find($id_breve);
		
		if ($breve) {
			$em->remove($breve);
			$em->flush();
		}
		else
			throw $this->createNotFoundException(
				'Aucune brève trouvée pour cet id: '.$id_breve
			);
		
		return $this->redirect($this->generateUrl('DFBreveBundle_listeBreveAdmin'));
	}
	
	/**
	 * Liste des brèves
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function listeBreveAdminAction()
	{
		$rep_breve = $this->getDoctrine()->getRepository('DFBreveBundle:Breve');
		
		$breves = $rep_breve->getListeBreves();
		
		return $this->render('DFBreveBundle:Private:listBreve.html.twig', array(
			'breves' => $breves,
		));
	}
	
	/**
	 * Mise à jour d'une brève
	 * @param integer $id_breve Identifiant de la brève
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function updateBreveAction($id_breve)
	{
		$em = $this->getDoctrine()->getManager();
		$breve = $em->getRepository('DFBreveBundle:Breve')->find($id_breve);
		
		if ($breve) {
			$form = $this->createForm(new BreveType(), $breve);
			
			$request = $this->get('request');
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
					
				if ($form->isValid()) {
					$illustration = new Crawler($breve->getIllustration());
					if ($illustration->filter('img')->count() == 1)
						$breve->setIllustration($illustration->filter('img')->attr('src'));
					$em = $this->getDoctrine()->getManager();
					$em->persist($breve);
					$em->flush();
				}
					
				return $this->redirect($this->generateUrl('DFBreveBundle_listeBreveAdmin'));
			}
		}
		else
			throw $this->createNotFoundException(
				'Aucune brève trouvée pour cet id: '.$id_breve
			);
		
		return $this->render('DFAdminBundle:Private:form.html.twig', array(
			'form' => $form->createView(),
			'titleCategorie' => 'Brèves',
			'title' => 'Modifier brève : ' . $breve->getTitle(),
		));
	}
	
}