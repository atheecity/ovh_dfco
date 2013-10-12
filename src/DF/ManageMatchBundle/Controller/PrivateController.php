<?php

namespace DF\ManageMatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use JMS\SecurityExtraBundle\Annotation\Secure;

use DF\ManageMatchBundle\Entity\FeuilleMatch;
use DF\ManageMatchBundle\Entity\Composition;
use DF\ManageMatchBundle\Entity\Groupe;
use DF\ManageMatchBundle\Entity\But;
use DF\ManageMatchBundle\Form\CompositionType;
use DF\ManageMatchBundle\Form\GroupeType;
use DF\ManageMatchBundle\Form\ButType;

class PrivateController extends Controller
{

	/**
	 * Créer une nouvelle feuille de match
	 * @param integer $match_id Identifiant match
	 * @return \DF\ManageMatchBundle\Controller\Response
	 * 
	 * @Secure(roles="ROLE_REDACTEUR")
	 */
    public function newFeuilleMatchAction($match_id)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$match = $em->getRepository('DFMatchBundle:Matchs')->find($match_id);
    	
        $feuilleMatch = new FeuilleMatch();
        $match->setFeuilleMatch($feuilleMatch);
        
        $em->persist($feuilleMatch);
        $em->persist($match);
        $em->flush();
        
        $response = array("code" => 100, "success" => true, "feuille_id" => $feuilleMatch->getId());
        return new Response(json_encode($response));
    }
    
    /**
     * Affiche la feuille de match
     * @param integer $feuille_id Identifiant feuilleMatch
     * 
     * @Secure(roles="ROLE_REDACTEUR")
     */
    public function displayFeuilleMatchAction($feuille_id)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$match = $em->getRepository('DFMatchBundle:Matchs')->findOneByFeuilleMatch($feuille_id);
    	$buts = $em->getRepository('DFManageMatchBundle:But')->findByMatch($match);
    	
    	return $this->render('DFManageMatchBundle:Private:displayFeuilleMatch.html.twig', array(
    		'match' => $match,
    		'buts' => $buts,
    	));
    }
    
    /**
     * Créer une nouvelle composition
     * @param unknown $feuille_id
     * @param unknown $type_equipe
     * 
     * @Secure(roles="ROLE_REDACTEUR")
     */
    public function newCompositionAction($feuille_id, $type_equipe)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$match = $em->getRepository('DFMatchBundle:Matchs')->findOneByFeuilleMatch($feuille_id);
    	
    	$feuilleMatch = $em->getRepository('DFManageMatchBundle:FeuilleMatch')->find($feuille_id);
    	
    	$composition = new Composition();
    	
    	if ($type_equipe == 'home')
    		$form = $this->createForm(new CompositionType(), $composition, array('club' => $match->getEquipeDom()));
    	else 
    		$form = $this->createForm(new CompositionType(), $composition, array('club' => $match->getEquipeExt()));
    	
    	$request = $this->get('request');
    	if ($request->getMethod() == 'POST') {
    		$form->bind($request);
    	
    		if ($form->isValid()) {
    			$em = $this->getDoctrine()->getManager();
    			
    			if ($type_equipe == 'home')
    				$feuilleMatch->setCompositionDom($composition);
    			else 
    				$feuilleMatch->setCompositionExt($composition);
    			
    			$em->persist($composition);
    			$em->persist($feuilleMatch);
    			$em->flush();
    		}
    	}
    	
    	return $this->render('DFAdminBundle:Private:form.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'Composition'
    	));
    }
    
    public function newGroupeAction($match_id)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$match = $em->getRepository('DFMatchBundle:Matchs')->find($match_id);
    	
    	$groupe = new Groupe();
    	
    	$form = $this->createForm(new GroupeType(), $groupe);
    	
    	return $this->render('DFAdminBundle:Private:form.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'Groupe'
    	));
    }
    
    public function newButAction($match_id, $club_id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$match = $em->getRepository('DFMatchBundle:Matchs')->find($match_id);
    	$club = $em->getRepository('DFEquipeBundle:Club')->find($club_id);
    	
    	$but = new But();
    	$but->setMatch($match);
    	$but->setEquipe($club);
    	
    	$form = $this->createForm(new ButType(), $but, array('club' => $club_id));
    	
    	$request = $this->get('request');
    	if ($request->getMethod() == 'POST') {
    		$form->bind($request);
    		 
    		if ($form->isValid()) {
				$em->persist($but);
    			$em->flush();
    		}
    		
    		return $this->redirect($this->generateUrl('DFManageMatchBundle_displayFeuilleMatch', array(
    			'feuille_id' => $match->getFeuilleMatch()->getId()
    		)));
    	}
    	
    	return $this->render('DFAdminBundle:Private:form.html.twig', array(
    		'form' => $form->createView(),
    		'title' => 'Ajouter but',
    	));
    }
}
