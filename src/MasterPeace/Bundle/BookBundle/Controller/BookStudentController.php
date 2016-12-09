<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookStudentController extends Controller
{
    /**
     * @Route ("/book")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('student_book_view');
    }

    /**
     * @Route ("/book/view/{id}", name="student_book_view")
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id): Response
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $book = $em
            ->getRepository('MasterPeaceBookBundle:Book')
            ->find($id);

        return $this->render('MasterPeaceBookBundle:Book/Student:view.html.twig', [
            'book' => $book,
        ]);
    }
}
