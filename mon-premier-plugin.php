<?php

/**
* Plugin Name: Mon Premier Plugin
* Description: Premier plugin wordpress créer par Robin Tirole afin d'exécuter des tests
* Version:     1.0.0
* Author:      Robin Tirole
* Domain Path: /languages
*/

//Fonction qui envoie par email les infos d'un email supprimé
function rti_post_delete_mail($post_id) {
    //Récupére les informations de l'article supprimé
    $post = get_post($post_id);
    //Création du sujet de l'email
    $sujet = "Article supprimé :" . $post->post_title;
    //Création du contenu de l'email
    $message = "Contenu de l'article : " . $post->post_content;
    //Envoi de l'email à l'administrateur du site
    wp_mail(get_bloginfo('admin_email'), $sujet, $message);
}
//Ajout d'une action sur 'delete_post' qui appellera mon_plugin_post_delete_mail()
add_action('delete_post', 'rti_post_delete_mail');

