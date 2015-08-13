<?php

namespace KITJAMBON\MembreBundle\Controller;

use KITJAMBON\MembreBundle\Services\KITJAMBONARFilter; // Pour les constantes de filtre

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction($name='')
    {
    	//Filtre droit d'accès
    	$rightsFilter = $this->get('kitjambon_membre.arfilter');

        if($rightsFilter->doPageFilter($this,$url,KITJAMBONARFilter::STATUT_ADMIN))
        	return new RedirectResponse($url);

        // Rendu
        return $this->render('KITJAMBONMembreBundle:Default:index.html.twig', array('name' => $name));
    }
}
