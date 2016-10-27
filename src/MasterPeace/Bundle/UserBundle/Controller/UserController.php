<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/list")
     * @return Response
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('MasterPeaceUserBundle:User');

        $users = $repository->findAll();

        return $this->render('@MasterPeaceUser/list.html.twig', ['users' => $users]);
    }
}
