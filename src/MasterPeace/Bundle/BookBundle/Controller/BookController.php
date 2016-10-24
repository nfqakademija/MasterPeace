<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * @Route ("/", name="book_list")
     *
     * @return Response
     */
    public function listAction()
    {
        return $this->render('MasterPeaceBookBundle:Book:list.html.twig');
    }

    /**
     * @Route ("/view/{id}", name="book_view")
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id)
    {
        return $this->render('MasterPeaceBookBundle:Book:view.html.twig');
    }
}
