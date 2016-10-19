<?php

namespace TodoBundle\Controller;

use TodoBundle\Entity\Todo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller
{
    public function listAction()
    {
        $todos = $this->getDoctrine()
            ->getRepository('TodoBundle:Todo')
            ->findAll();
        return $this->render('TodoBundle:Todo:index.html.twig', array('todos' => $todos));
    }

    public function createAction(Request $request)
    {
        $todo = new Todo();

        $form = $this->createFormBuilder($todo)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;')))
            ->add('priority', ChoiceType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;'), 'choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High')))
            ->add('due_date', DateTimeType::class, array('attr' => array('style' => 'margin-bottom: 15px;')))
            ->add('save', SubmitType::class, array('label' => 'Create New Todo', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px;')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Get Data
            $name = $form['name']->getData();
            $category = $form['category']->getData();
            $description = $form['description']->getData();
            $priority = $form['priority']->getData();
            $due_date = $form['due_date']->getData();

            $now = new\DateTime('now');

            $todo->setName($name);
            $todo->setCategory($category);
            $todo->setDescription($description);
            $todo->setPriority($priority);
            $todo->setDueDate($due_date);
            $todo->setCreateDate($now);

            $em = $this->getDoctrine()->getManager();

            $em->persist($todo);
            $em->flush();
            $this->addFlash('notice','New Todo Added');

            return $this->redirectToRoute('todo_list');

        }

        return $this->render('TodoBundle:Todo:create.html.twig', array('form' => $form->createView()));
    }

    public function editAction($id, Request $request)
    {
        $todo = $this->getDoctrine()
            ->getRepository('TodoBundle:Todo')
            ->find($id);

        $now = new\DateTime('now');

        $todo->setName($todo->getName());
        $todo->setCategory($todo->getCategory());
        $todo->setDescription($todo->getDescription());
        $todo->setPriority($todo->getPriority());
        $todo->setDueDate($todo->getDueDate());
        $todo->setCreateDate($now);

        $form = $this->createFormBuilder($todo)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;')))
            ->add('priority', ChoiceType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px;'), 'choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High')))
            ->add('due_date', DateTimeType::class, array('attr' => array('style' => 'margin-bottom: 15px;')))
            ->add('save', SubmitType::class, array('label' => 'Edit Todo', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px;')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Get Data
            $name = $form['name']->getData();
            $category = $form['category']->getData();
            $description = $form['description']->getData();
            $priority = $form['priority']->getData();
            $due_date = $form['due_date']->getData();

            $em = $this->getDoctrine()->getManager();
            $todo = $em->getRepository('TodoBundle:Todo')->find($id);

            $todo->setName($name);
            $todo->setCategory($category);
            $todo->setDescription($description);
            $todo->setPriority($priority);
            $todo->setDueDate($due_date);
            $todo->setCreateDate($now);

            $em->flush();
            $this->addFlash('notice','Todo Edited!');

            return $this->redirectToRoute('todo_list');

        }
        return $this->render('TodoBundle:Todo:edit.html.twig', array('todo' => $todo, 'form' => $form->createView()));
    }

    public function detailsAction($id)
    {
        $todos = $this->getDoctrine()
            ->getRepository('TodoBundle:Todo')
            ->find($id);
        return $this->render('TodoBundle:Todo:details.html.twig', array('todo' => $todos));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $todo = $em->getRepository('TodoBundle:Todo')
            ->find($id);

        $em->remove($todo);

        $em->flush();
        $this->addFlash('notice','Todo Removed!');

        return $this->redirectToRoute('todo_list');
    }
}
