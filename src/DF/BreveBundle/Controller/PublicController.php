<?php 

namespace DF\BreveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;

class PublicController extends Controller
{
	
	/**
	 * Liste des brèves
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function moduleListeBreveAction()
	{
		$rep_breve = $this->getDoctrine()->getRepository('DFBreveBundle:Breve');
		
		$breves = $rep_breve->getBreveIsPublish(8);
		
		return $this->render('DFBreveBundle:Public:lstBreve.html.twig', array(
				'breves' => $breves,
		));
	}
	
	/**
	 * Affiche une brève
	 * @param integer $id_breve Identifiant de la brève
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function afficherBreveAction($id_breve)
	{
		$rep_breve = $this->getDoctrine()->getRepository('DFBreveBundle:Breve');
		$breve = $rep_breve->find($id_breve);
		
		return $this->render('DFBreveBundle:Public:afficherBreve.html.twig', array(
				'breve' => $breve
		));
	}
	
	public function listeBreveAction()
	{
		$rep_breve = $this->getDoctrine()->getRepository('DFBreveBundle:Breve');
		$breves = $rep_breve->findBy(
			array('isPublish' => true), 
			array('datePublication' => 'DESC')
		);
		
		return $this->render('DFBreveBundle:Public:listeBreve.html.twig', array(
				'breves' => $breves,
		));
	}
	
}