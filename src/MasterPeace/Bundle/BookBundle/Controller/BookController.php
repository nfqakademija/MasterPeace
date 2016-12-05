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
     * @Route ("/")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->redirectToRoute('book_list');
    }

    /**
     * @Route ("/list", name="book_list")
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
     * @Route ("/view/{id}", name="book_view")
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $book = $em
            ->getRepository('MasterPeaceBookBundle:Book')
            ->find($id);

        return $this->render('MasterPeaceBookBundle:Book:view.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route ("/create", name="book_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);
        $form->setData($book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('book_list');
        }

        return $this->render('MasterPeaceBookBundle:Book:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/edit/{id}", name="book_edit")
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request, int $id)
    {
        $book = $this->getBookOr404($id);

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('book_view', [
                'id' => $id,
            ]);
        }

        return $this->render('MasterPeaceBookBundle:Book:edit.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
        ]);
    }

    /**
     * @Route ("/delete/{id}", name="book_delete")
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id)
    {
        $book = $this->getBookOr404($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('book_list');
    }

    /**
     * @param int $id
     *
     * @return Book
     */
    private function getBookOr404(int $id)
    {
        $book = $this->getDoctrine()->getRepository('MasterPeaceBookBundle:Book')->find($id);

        if (null === $book) {
            $this->createNotFoundException('Book not found');
        }

        return $book;
    }
}
