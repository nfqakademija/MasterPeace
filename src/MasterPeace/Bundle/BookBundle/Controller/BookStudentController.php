<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_STUDENT')")
 */
class BookStudentController extends Controller
{
    /**
     * @Route ("/book/view/{id}", name="student_book_view")
     *
     * @param Book $book
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function viewAction(Book $book): Response
    {
        $hasBook = $this->getDoctrine()
            ->getRepository('MasterPeaceUserBundle:User')
            ->hasStudentBook($this->getUser(), $book);

        if (false === $hasBook) {
            throw $this->createAccessDeniedException("Student do not have access to requested book");
        }

        return $this->render('MasterPeaceBookBundle:Book/Student:view.html.twig', [
            'book' => $book,
        ]);
    }
}
