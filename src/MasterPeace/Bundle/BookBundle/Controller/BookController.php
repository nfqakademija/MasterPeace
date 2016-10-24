<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BookController extends Controller
{
    /**
     * @Route ("/", name="book_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render('BookBundle:Book:list.html.twig');
    }

    /**
     * @Route ("/view/{id}", name="book_view")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(int $id)
    {
        return $this->render('BookBundle:Book:view.html.twig');
    }
}
