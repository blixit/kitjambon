<?php

/* 
 * Projet : Kit-jambon
 * By Alain Ngangoue
 * Fichier : 
 * Role :  model contact_membre
 * La relation contient 2 champs : mem_id_1 et mem_id_2.
 * mem_id_1 : Celui qui est le premier entré en contact
 * mem_id_2 : Celui qui est censé accepté la demande de contact
 */
/* ATTENTION
         * 
         */
class Contact_membre extends Model{
    public $tables = array(
            'default' => 'contact_membre' 
    ); 

} 
