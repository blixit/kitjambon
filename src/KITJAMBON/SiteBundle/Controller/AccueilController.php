<?php

namespace KITJAMBON\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
        return $this->render('KITJAMBONSiteBundle:Default:index.html.php', array());
    }
}
