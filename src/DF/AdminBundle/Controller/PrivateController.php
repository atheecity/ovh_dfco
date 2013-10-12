<?php

namespace DF\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrivateController extends Controller
{
    public function homePageAction()
    {
        return $this->render('DFAdminBundle:Private:home.html.twig');
    }
}