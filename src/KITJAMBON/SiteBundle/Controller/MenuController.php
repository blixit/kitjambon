<?php

namespace KITJAMBON\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function mainAction()
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

		//liste des options triées par année
		$options['options'] = array();
		foreach ($options['annees'] as $key => $value) { 
			$options['options'][$value['optionAnnee']] = $repository->getListeOptionsByAnnee($value['optionAnnee']);
		}

        return $this->render('KITJAMBONSiteBundle:Menu:main.html.php', 
        	array(
        		'modules' => $modules,
        		'options' => $options,
        		));
    }
}
