<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route ("/add", name="book_add")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('book_list');
        }

        return $this->render('MasterPeaceBookBundle:Book:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
