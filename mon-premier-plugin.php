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


//Shortcode de récupération de données
/**
 * Shortcode qui retourne le célèbre "Luke, Je sui ton père !" dans un élément blockquote.
 * Le contenu du shortcode sera utilisé pour remplacer 'Luke'
 * L'attribut tag du shortcode permet de remplacer l'élément blockquote par : p, h1, h2 ou div
 *
 * Exemples :
 * [vador] => <blockquote>Luke, Je sui ton père !</blockquote>
 * [vador]Serge[/vador] => <blockquote>Serge, Je sui ton père !</blockquote>
 * [vador tag="div"]Jean-Marc[/vador] => <div>Jean-Marc, Je sui ton père !</div>
 */

function rti_vador_shortcode($atts, $content = "") {
    // Tag par défaut
    $tag = 'blockquote';

    // Si $tag valide on le récupère
    if(isset($atts['tag']) AND in_array($atts['tag'], ['p','h1','h2','div'])) {
        $tag = $atts['tag'];
    }

    // Si contenu vide
    if (empty( $content )) {
        $content = 'Luke';
    }

    return '<' . $tag . '>' . $content . ', Je suis ton père !' . '';
}
//Fonction de rappel qui retourne la célèbre citation de maître Yoda
function rti_yoda_shortcode() {
    return "<blockquote>Que la force soit avec toi jeune padawan !</blockquote>";
}

//Enregistre les shortcodes du plugin
function rti_register_shortcode() {
    add_shortcode( 'yoda', 'rti_yoda_shortcode' );
    add_shortcode( 'vador', 'rti_vador_shortcode' );
}
add_action( 'init', 'rti_register_shortcode' );