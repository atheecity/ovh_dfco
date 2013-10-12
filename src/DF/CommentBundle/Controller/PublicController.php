<?php 

namespace DF\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use DF\CommentBundle\Entity\Thread;

class PublicController extends Controller 
{
	
	public function getNumberCommentAction($id)
	{
		$thread = new Thread();
		$thread = $this
			->getDoctrine()
			->getManager()
			->getRepository('DFCommentBundle:Thread')
			->find($id);
		
		if(!$thread)
			return new Response(0);
		else		
			return new Response($thread->getNumComments());
	}
}