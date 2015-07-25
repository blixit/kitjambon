<?php
/*
 * Alain Ngangoue 
 * Nicolas ANTOINE
 * index.php :  Point d'entrée du site
 */
/* Définitions des paramètres de configuration */
    require_once '../config/parametres.php';
    
/* Fichier d'inclusions */
    include_once CORE.DS.'includes.php';
    
/* Lancement de l'application */
    $dispatcher = new Dispatcher;

    unset($dispatcher);
