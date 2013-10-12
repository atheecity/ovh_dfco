<?php

namespace DF\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    public function homeAction()
    {
        return $this->render('DFHomeBundle:Public:home.html.twig');
    }
    
    public function slideAction()
    {
    	$rep_breve = $this->getDoctrine()->getRepository('DFBreveBundle:Breve');
    	$breves = $rep_breve->findBy(
    		array('isPublishSlide' => '1'), 
    		array('datePublication' => 'DESC')	
    	);
    	
    	return $this->render('DFHomeBundle:Public:slide.html.twig', array(
    			'breves' => $breves
    	));
    }
}