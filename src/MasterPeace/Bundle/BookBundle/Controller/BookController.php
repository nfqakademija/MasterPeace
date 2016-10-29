<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends Controller
{
    /**
     * @Route ("/", name="book_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $books = $em
            ->getRepository('MasterPeaceBookBundle:Book')
            ->findAll();

        return $this->render('MasterPeaceBookBundle:Book:list.html.twig', [
            'books' => $books,
        ]);
    }
}
