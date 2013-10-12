<?php 

namespace DF\ReportersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;

class PublicController extends Controller
{
	
	public function reportersAction()
	{
		return $this->render('DFReportersBundle:Public:reporters.html.twig');
	}
	
}