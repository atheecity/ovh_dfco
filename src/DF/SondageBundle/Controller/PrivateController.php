<?php

namespace DF\SondageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
			'title' => 'Ajouter un sondage',
		));
	}
	
}
