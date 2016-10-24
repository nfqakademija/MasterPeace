<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BookController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        return $this->render('BookBundle:Book:list.html.twig');
    }

    /**
     * @Route("/view/{id}")
     */
    public function viewAction(int $id)
    {
        return $this->render('BookBundle:Book:view.html.twig');
    }
}
