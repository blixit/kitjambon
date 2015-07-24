<?php
/*
 *  Alain Ngangoue
 * includes.php
 * Inclusion des classes nécessaires au fonctionnement du site
 * 
 */
    require_once 'fonctions.php';   // fonctions utiles
    require_once 'router.php';      // système de routing
    require_once 'urls.php';        // associations des urls
    require_once 'request.php';     // traitement de la requête de l'utilisateur
    require_once 'model.php';       // fonctions de base de données
    require_once 'controller.php';  // gestion d'un controller
    require_once 'dispatcher.php';  // structure du site : repose sur le modèle MVC
    require_once 'session.php';     // gestion des sessions
    require_once 'scripts.php';     // fonctions génératrices de scripts
    require_once 'mail.php';     	// gestion des mails