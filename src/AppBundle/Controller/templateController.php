<?php
/**
 * Created by PhpStorm.
 * User: indel
 * Date: 10/15/16
 * Time: 10:25 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class templateController
{
    /**
     * @Route("/template/{templateName}")
     */
    public function showAction($templateName)
    {
        return new Response("Template for pages: ".$templateName);
    }
}