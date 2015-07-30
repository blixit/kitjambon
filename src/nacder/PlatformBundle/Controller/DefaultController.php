<?php

namespace nacder\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('nacderPlatformBundle:Default:index.html.twig', array('name' => $name));
    }
}
