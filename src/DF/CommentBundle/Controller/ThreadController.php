<?php 

namespace DF\CommentBundle\Controller;

use FOS\CommentBundle\Controller\ThreadController as Controller;
use FOS\CommentBundle\Model\ThreadInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ThreadController extends Controller 
{
}