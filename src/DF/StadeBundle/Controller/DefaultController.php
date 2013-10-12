<?php

namespace DF\StadeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DFStadeBundle:Default:index.html.twig', array('name' => $name));
    }
}
