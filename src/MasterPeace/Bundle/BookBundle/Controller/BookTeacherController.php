<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_TEACHER')")
 */
class BookTeacherController extends Controller
{
    /**
     * @Route ("/book")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('teacher_book_list');
    }

    /**
     * @Route ("/book/list", name="teacher_book_list")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('MasterPeaceBookBundle:Book')->findBy([
            'teacher' => $this->getUser()->getId(),
        ]);

        return $this->render('MasterPeaceBookBundle:Book/Teacher:list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route ("/book/view/{id}", name="teacher_book_view")
     *
     * @param Book $book
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function viewAction(Book $book): Response
    {
        $this->validateEntityCreator('View', $book);
        return $this->render('MasterPeaceBookBundle:Book/Teacher:view.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route ("/book/create", name="teacher_book_create")
     *
     * @param Request $request
     *
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $book = new Book();
        $book->setTeacher($this->getUser());
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('teacher_book_view', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('MasterPeaceBookBundle:Book/Teacher:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/book/edit/{id}", name="teacher_book_edit")
     *
     * @param Book $book
     * @param Request $request
     *
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function editAction(Request $request, Book $book): Response
    {
        $this->validateEntityCreator('Edit', $book);
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('teacher_book_view', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('MasterPeaceBookBundle:Book/Teacher:edit.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
        ]);
    }

    /**
     * @Route ("/book/delete/{id}", name="teacher_book_delete")
     *
     * @param Request $request
     * @param Book $book
     *
     * @Method("DELETE")
     *
     * @return Response
     */
    public function deleteAction(Request $request, Book $book): Response
    {
        if (false === $this->isCsrfTokenValid($book->getTitle() . $book->getId(), $request->request->get('token'))) {
            throw $this->createAccessDeniedException('DELETE: CSRF token is invalid');
        }
        $this->validateEntityCreator('Delete', $book);
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('teacher_book_list');
    }

    /**
     * @param string $actionName
     * @param Book $book
     */
    private function validateEntityCreator(string $actionName, Book $book)
    {
        if ($this->getUser() !== $book->getTeacher()) {
            throw $this->createNotFoundException(strtoupper($actionName).': Classroom not found');
        }
    }
}
