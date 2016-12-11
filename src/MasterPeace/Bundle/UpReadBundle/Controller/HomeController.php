<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function redirectAction(): Response
    {
        return $this->redirect('/login');
    }

    /**
     * @Route("/invite/{inviteCode}", name="invite")
     *
     * @Method("GET")
     *
     * @param $inviteCode
     *
     * @return Response
     */
    public function inviteAction($inviteCode): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_STUDENT')) {
            $em = $this->getDoctrine()->getEntityManager();
            $classroom = $em->getRepository("MasterPeaceClassroomBundle:Classroom")->findOneBy([
                'inviteCode' => $inviteCode,
            ]);
            if (is_null($classroom)) {
                $this->createNotFoundException(strtoupper('Classroom not found'));
            } else {
                $classroom->addStudent($this->getUser());
                $em->persist($classroom);
                $em->flush();

                return $this->redirectToRoute('student_classroom_view', [
                    'id' => $classroom->getId(),
                ]);
            }
        }

        return $this->redirect('/login');
    }

    /**
     * @Route("/usercheck")
     *
     * @Method("GET")
     *
     * @return Response
     */
    public function userCheckAction(): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_TEACHER')) {
            return $this->redirect('/teacher/classroom/list');
        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_STUDENT')) {
            return $this->redirect('/student/classroom/list');
        } else {
            return $this->redirectToRoute('homepage');
        }
    }
}
