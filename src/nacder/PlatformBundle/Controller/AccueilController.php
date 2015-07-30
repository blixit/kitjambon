<?php

namespace nacder\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{
    public function indexAction()
    {
    	$name = "rrr"; 
    	$footer = 'PIED DE PAGE';
    	$title = "titre de page";

        //return new Response("Bienvenue sur la nouvelle plateforme de kitjambon.");
        return $this->render('nacderPlatformBundle:Accueil:index.html.twig', array('name' => $name));
         
    }
}
