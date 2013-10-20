<?php

namespace DF\SondageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use DF\SondageBundle\Entity\Question;
use DF\SondageBundle\Form\QuestionType;

class PrivateController extends Controller
{
    
	public function listSondageAction() 
	{
		$em = $this->getDoctrine()->getManager();
		
		$sondages = $em->getRepository('DFSondageBundle:Question')->findAll();
		
		return $this->render('DFSondageBundle:Private:listSondage.html.twig', array(
			'sondages' => $sondages,
		));
	}
	
	/**
	 * Ajouter un sondage
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
	public function newSondageAction()
	{
		$question = new Question();
		$form = $this->createForm(new QuestionType(), $question);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
				
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($question);
				$em->flush();
			}
				
			return $this->redirect($this->generateUrl('DFBreveBundle_listeBreveAdmin'));
		}
		
		return $this->render('DFSondageBundle:Private:formSondage.html.twig', array(
			'form' => $form->createView(),
			'titleCategorie' => 'Sondages',
			'title' => 'Ajouter un sondage',
		));
	}
	
}
