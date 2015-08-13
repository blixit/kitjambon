<?php

namespace KITJAMBON\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoursController extends Controller
{
    public function indexAction()
    {
    	$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('KITJAMBONSiteBundle:Options')
		;
  		
  		//liste des modules
		$modules = $repository->getOrderedModules();  
		 
		//liste des années
		$options['annees'] = $repository->getListeAnnee();
 
        return $this->render('KITJAMBONSiteBundle:Cours:view.html.php', 
        	array(
        		'modules' => $modules,
        		'options' => $options
        	));
    }

    public function viewAction($eix){
    	$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('KITJAMBONSiteBundle:Options')
		;
  		
  		//liste des modules
		$modules = $repository->getOrderedModulesByAnnee($eix);  
		 
		//liste des années
		$options['annees'] = array(array('optionAnnee'=>$eix));
 
    	return $this->render('KITJAMBONSiteBundle:Cours:view.html.php', 
        	array(
        		'modules' => $modules,
        		'options' => $options 
        	));
    }
}
