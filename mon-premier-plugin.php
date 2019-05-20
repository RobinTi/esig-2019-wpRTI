<?php

/**
* Plugin Name: Mon Premier Plugin
* Description: Premier plugin wordpress créer par Robin Tirole afin d'exécuter des tests
* Version:     1.0.0
* Author:      Robin Tirole
* Domain Path: /languages
*/

//Action
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


//Filtre
//Fonction qui remplace la chaine 'et' par '&amp;'
function mon_plugin_the_title( $title ) {
    //Remplace 'et' dans le titre
    $title = str_replace( 'et', '&amp;', $title );
    //Retourne le titre modifié
    return $title;
}
//Ajout d'un filtre sur 'the_title' qui appellera mon_plugin_the_title()
add_filter( 'the_title', 'mon_plugin_the_title' );


//Shortcode
//Fonction de rappel qui retourne la célèbre citation de maître Yoda
function rti_yoda_shortcode() {
    return "<blockquote>Que la force soit avec toi jeune padawan !</blockquote>";
}

//Enregistre les shortcodes du plugin
function rti_register_shortcode() {
    add_shortcode( 'yoda', 'rti_yoda_shortcode' );
}
add_action( 'init', 'rti_register_shortcode' );