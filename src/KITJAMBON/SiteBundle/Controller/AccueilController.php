<?php

namespace KITJAMBON\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KITJAMBONSiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
