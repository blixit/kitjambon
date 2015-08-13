<?php
// src/KITJAMBON/MembreBundle/Services/KITJAMBONARFilter.php

namespace KITJAMBON\MembreBundle\Services;

use Doctrine\ORM\EntityRepository;


class KITJAMBONARFilter  
{
	/**
	*	Liste des différents statuts d'utilisateurs (différents des grades).
	*/
	const STATUT_ADMIN = 3;
	const STATUT_USER = 2;
	const STATUT_GUEST = 1;
	/**
	*   Le tableau suit la logique suivante
	* 	Admin > user > guest.
	*/
	public $user_filter_level = [
		"administrateur" => 3,
		"user" => 2,
		"guest" => 1,
		];

	/**
	* Vérifie que l'utilisateur a le droit de visualiser cette page est un spam ou non
	*
	* @param string $controller Le controller qui contient le Doctrine Manager.
	* @param string $level Niveau de droits de l'utilisateur. Par défaut 2, donc user. 
	* Toute page nécessite une connexion.
	* @return bool True : on ordonne au controller appelant de rediriger.
	*/
	public function doPageFilter($controller,&$url,$level=2)
	{
		$repository = $controller
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('KITJAMBONMembreBundle:Membre')
		;

		$membre = current($repository->findAll()); 

		if ($this->user_filter_level[$membre->getMembreStatut()] < $level){

			$url = $controller->get('router')->generate('kitjambon_membre_account_restreint');
			return true;
		}
		return false;
	}

	 
}