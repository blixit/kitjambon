<?php

namespace KITJAMBON\MembreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller
{
    public function restrictedAction()
    { 
        return $this->render('KITJAMBONMembreBundle:Account:restricted.html.php', array());
    }

    public function adblockRestrictedAction()
    { 
        return $this->render('KITJAMBONMembreBundle:Account:adblockRestricted.html.php', array());
    }
}
