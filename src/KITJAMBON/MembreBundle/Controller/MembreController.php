<?php

namespace KITJAMBON\MembreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MembreController extends Controller
{
	/**
	*  Affiche les infos publiques d'un utilisateur
	*  @param $id l'identifiant de l'utilisateur
	*/
    public function viewAction($id)
    { 
        return $this->render('KITJAMBONMembreBundle:Membre:view.html.php', array());
    }

    /**
	*  Affiche les infos privées d'un utilisateur et son activité
	*  @param $id l'identifiant de l'utilisateur
	*/
    public function profilAction($id)
    { 
        return $this->render('KITJAMBONMembreBundle:Membre:profil.html.php', array());
    }

    /**
	*  Affiche le compte d'un utilisateur
	*  @param $page la page des résultats à afficher
	*  @param $eix l'année de l'élève
	*/
    public function listeAction($page,$eix)
    { 
        return $this->render('KITJAMBONMembreBundle:Membre:liste.html.php', array());
    }
}
