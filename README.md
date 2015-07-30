===================================
	Kitjambon
===================================

Site du kit jambon

===================================
	Contributeurs
===================================

Auteur : Alain NGANGOUE
Collaborateur : Nicolas ANTOINE

===================================
	TODO
===================================

Finaliser l'arborescence des fichiers
Formater le nom des fichiers
Ajouter les fichiers de la nouvelle version (ceux qui ont été ajoutés cette année)

===================================
	Questions
===================================


Pourquoi il y a des tables avec openu et d'autres sans ?

DANS cfile.php
Que veut dire $object ?
contient le chemin d'un fichier
Que veut dire $object['doc_'] ?
renvoie la colonne indicé par 'doc_'
basename($object);
renvoie le nom d'un fichier dans un chemin
fileatime($object);
renvoie la date de dernier acces d'un fichier
filemtime($object);
renvoie la date de derniere modification d'un fichier
filesize($object); 
renvoie la taille d'un fichier

===================================
    Description fonctionnelle
===================================

On définit les paramètres.
On définit toutes les classes
On crée une instance du dispatcher qui se charge d'appeler le bon controller

===================================
     Description structurelle
===================================

*anthonynacderneyykitjam.sql
	sauvegarde de la base de données du 9 mai 2015
	
*architect.architect
	permet de visualiser un modèle de la base de données

*create_sondage_table
	commande pour créer de nouvelle tables dans la base de données concernant les sondages.

*google-site-verification: googled88115a2600518fc.html
	Pour confirmer l'appartenance du site
	
*index.php
	lance un readMyFile qui cartographie les fichiers contenus dans filesOld et tous les chemins.
	
*liste.txt
	Liste des cours et de leurs abréviations
	
*README.md
	affiche toutes les infos sur le projet
	
*sitemap.xml
	fichier permettant aux moteurs de recherche de connaitre facilement les champs d'adresse accessibles. Il s'agit d'une aide pour les robots d'indexation
	
*wb.mwb
	my sql work batch outil pour gérer les bases de données
	
/config
*parametres.php
	contient les informations permettant d'accéder à la base de données par exemple...
	
/controller
*AccueilController.php
	gère toutes les requêtes accueil
	contient une fonction index qui permet d'interroger la base de données sur les derniers fichiers uploadé sur le nombre de fichiers de membres c'est a dire les infos susceptibles d'être présentées sur la page d'accueil
	
*AjaxController.php
	controller qui permet de rafraichir une partie du site.
	ex: search file

*CoursController.php
	
	
*DownloadController.php

*HomeController.php

*MembreController.php

*PagesController.php

*PetitionController.php

*SondageController.php

*UploadController.php


/core
*cfile.php
	contient les fonctions qui permettent de gérer les fichiers qui ne sont pas dans la base de données

*controller.php
	definit la classe controller dont hérite la plupart des controllers. génére la page html, le menu ...
CLASSE A CREUSER POUR COMPRENDRE LA LIAISON AVEC LES VIEW

*dispatcher.php
	gère les requêtes et les redirige vers les controller
	
*fonctions.php

*includes.php

*mail.php

*model.php

*request.php

*router.php

*scripts.php

*session.php

*urls.php


/model
*contact_membre.php

*document.php

*groupe.php

*history.php

*membre.php

*reseau.php

*sondage.php


/openupload


/view

	
/webroot


===================================
	Erreurs
===================================

Attention dans le code de la page d'accueil </br> au lieu de <br/>
Dans cfile.php ReadMyfile, dans le while !== au lieu de !=
Dans cfile.php ReadMyfile, $base ne sert à rien.

===================================
	Message Facebook
===================================
Cc les jambons,  
Avec un trafic mensuel moyen entre 3 et 5 Go, le site est bien lancé maintenant, et ce, grâce à vous. 
Cependant, la majorité des fichiers actuels ne sont pas très récents. Nous pensons qu'il est donc temps de donner une nouvelle fraîcheur au site.
Pour ce faire, nous vous recommandons d'uploader les fichiers que vous souhaitez partager. 
