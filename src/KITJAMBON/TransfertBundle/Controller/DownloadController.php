<?php

namespace KITJAMBON\TransfertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DownloadController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KITJAMBONTransfertBundle:Default:index.html.twig', array('name' => $name));
    }

    public function viewAction($eix,$abrege,$dir=null){
    	return $this->render('KITJAMBONTransfertBundle:Default:index.html.twig', array('name' => $abrege));
    }
}
