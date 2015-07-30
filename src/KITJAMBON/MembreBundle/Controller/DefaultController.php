<?php

namespace KITJAMBON\MembreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KITJAMBONMembreBundle:Default:index.html.twig', array('name' => $name));
    }
}
