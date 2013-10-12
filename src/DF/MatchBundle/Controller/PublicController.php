<?php

namespace DF\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    
	/**
	 * Affiche le calendrier
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function afficherCalendrierAction()
	{
		$rep_matchs = $this->getDoctrine()->getRepository('DFMatchBundle:Matchs');
		$matchs = $rep_matchs->getCalendrierResultatsDfco(0,0);
		
		return $this->render('DFMatchBundle:Public:afficherCalendrier.html.twig', array(
			'matchs' => $matchs	
		));
	}
	
	/**
	 * Dernier match du DFCO
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function dernierMatchAction()
	{
		$rep_matchs = $this->getDoctrine()->getRepository('DFMatchBundle:Matchs');
		$match = $rep_matchs->getDernierMatch();
		
		return $this->render('DFMatchBundle:Public:dernierMatch.html.twig', array(
			'match' => $match	
		));
	}
	
	/**
	 * Prochain match du DFCO
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function prochainMatchAction()
	{
		$rep_matchs = $this->getDoctrine()->getRepository('DFMatchBundle:Matchs');
		$match = $rep_matchs->getProchainMatch();
		
		return $this->render('DFMatchBundle:Public:prochainMatch.html.twig', array(
			'match' => $match	
		));
	}
	
	/**
	 * Sélectionne le prochain ou le dernier match du DFCO
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function selectModuleMatchAction()
	{
		$dateNow = new \DateTime();
		
		$rep_matchs = $this->getDoctrine()->getRepository('DFMatchBundle:Matchs');
		$match = $rep_matchs->getProchainMatch();
		
		$dateMatch = $match->getDate();
		$dateMin = $dateMatch->sub(new \DateInterval('P3D'));	
		
		if ($dateNow >= $dateMin && $dateNow < $match->getDate()->add(new \DateInterval('P3D'))) {
			$response = $this->forward('DFMatchBundle:Public:prochainMatch');
		}
		else {
			$response = $this->forward('DFMatchBundle:Public:dernierMatch');
		}
		
		return $response;
	}
	
	public function afficherClassementAction()
	{
		$classement = $this->getClassement();
		
		return $this->render('DFMatchBundle:Public:afficherClassement.html.twig', array(
			'classement' => $classement,
		));
	}
	
	public function moduleClassementAction()
	{
		$classement = $this->getClassement();
		
		$pos = 1;
		foreach ($classement as $position) {
			if ($position->getClub()->getId() == 1) {
				$pos_club = $pos;
			}
			$pos++;
		}
		
		if ($pos_club < 3) {
			$min_classement = 1;
			$max_classement = 5;
		}
		else if ($pos_club > 17) {
			$min_classement = 16;
			$max_classement = 20;
		}
		else {
			$min_classement = $pos_club - 2;
			$max_classement = $pos_club + 2;
		}
		
		return $this->render('DFMatchBundle:Public:classement.html.twig', array(
			'classement' => $classement, 
			'min_classement' => $min_classement, 
			'max_classement' => $max_classement
		));
	}
	
	public function getClassement() 
	{
		$saison_id = $this->container->getParameter('saison');
		
		$em = $this->getDoctrine()->getManager();
		$classement = $em->getRepository('DFMatchBundle:Classement')->findBy(
			array('saison' => $saison_id),
			array('points' => 'DESC', 'diff' => 'DESC', 'butPour' => 'DESC', 'journee' => 'ASC', 'libelle' => 'ASC')
		);
		
		return $classement;
	}
	
}