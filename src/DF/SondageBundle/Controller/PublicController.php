<?php

namespace DF\SondageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DF\SondageBundle\Entity\UserVote;
use DF\SondageBundle\Entity\Question;
use JMS\SecurityExtraBundle\Annotation\Secure;

class PublicController extends Controller
{	
	
	public function moduleSondageAction(Request $request) 
	{
		$em = $this->getDoctrine()->getManager();
		
		$sondage = $em->getRepository('DFSondageBundle:Question')->getCurrentSondage();
		$user = $this->getUser();
		$userVote = $em->getRepository('DFSondageBundle:UserVote')->findOneBy(
				array('user' => $user, 'question' => $sondage)
		);
		
		if ($userVote)
			$res = $this->resultsSondageAction($sondage);
		else 
			$res = $this->voteSondageAction($sondage, $user, $request, $userVote);
		
		return $res;
	}
	
	/**
	 * @param Question $sondage
	 * @param unknown $user
	 * @param unknown $request
	 * @param unknown $userVote
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 */
	public function voteSondageAction(Question $sondage, $user, $request, $userVote)
	{
		$em = $this->getDoctrine()->getManager();
		
		foreach ($sondage->getReponses() as $reponse) {
			$rep[$reponse->getId()] = $reponse->getLibelle();
		}
		
		$form = $this->createFormBuilder()
		->add('vote', 'choice', array(
				'choices' => $rep,
				'expanded' => true,
				'multiple' => false,
				'label' => false,
		))
		->getForm();
		
		$form->handleRequest($request);
		if ($form->isValid()) {
			$data = $form->getData();
			$reponse = $em->getRepository('DFSondageBundle:Reponse')->find($data['vote']);

			if($user) {
				if ($sondage) {
					if ($sondage->isOpen()) {
						if (!$userVote) {
							$userVote = new UserVote();
							$userVote->setUser($user);
							$userVote->setQuestion($sondage);
							$userVote->setReponse($reponse);
			
							$em->persist($userVote);
							$em->flush();
			
							$response = array("code" => 100, "success" => true, "msg" => 'Merci pour ta participation.');
						}
						else
							$response = array("code" => 100, "success" => false, "erreur" => 'Vous avez déjà voté.');
					}
					else
						$response = array("code" => 100, "success" => false, "erreur" => 'Le sondage n\'est plus ouvert.');
				}
				else
					$response = array("code" => 100, "success" => false, "erreur" => 'Le sondage n\'existe pas.');
			}
			else
				$response = array("code" => 100, "success" => false, "erreur" => 'Vous devez être connecté.');
			
			return new Response(json_encode($response));
		}
		
		return $this->render('DFSondageBundle:Public:formModuleSondage.html.twig', array(
				'question' => $sondage,
				'form' => $form->createView(),
		));
	}
	
	public function resultsSondageAction(Question $question)
	{
		$results = $this->getResults($question);
		
		return $this->render('DFSondageBundle:Public:resultsModuleSondage.html.twig', array(
			'question' => $question,
			'results' => $results,
		));
	}
	
	/**
	 * Retourne les résultats du sondage
	 * @param Question $question
	 * @return multitype:unknown Tableau contenant les résultats du sondage
	 */
	private function getResults(Question $question)
	{
		$em = $this->getDoctrine()->getManager();
		$results = array();
		$results['total'] = 0;
		
		foreach ($question->getReponses() as $reponse) {
			$nbVote = $em->getRepository('DFSondageBundle:UserVote')->getNbVoteByReponse($reponse);
			$results[$reponse->getId()] = $nbVote[1];
			$results['total'] += $nbVote[1];
		}
		
		return $results;
	}
}
