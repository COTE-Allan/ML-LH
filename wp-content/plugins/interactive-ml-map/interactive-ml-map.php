<?php
/*
Plugin Name: Carte interactive de la Mission Locale
Plugin URI: https://ml-lehavre.fr/
Description: Un plugin conçu pour afficher une carte interactive des antennes de la Mission Locale Le Havre Estuaire Littoral.
Author: Julien Richard 
Version: 1.0
*/

// -----------------------------------------------------------------------------------------------
// Création du menu dans le back-office wordpress.

function carte_init()
{
    $args = array(
        "public"             => true,
        "publicly_queryable" => true,
        "show_ui"            => false,
        "show_in_menu"       => false,
        "query_var"          => true,
        "rewrite"            => array("slug" => "carte_ml"),
        "capability_type"    => "post",
        "capabilities"       => array("create_posts" => false),
        "hierarchical"       => false,
        "supports"           => array("title", "editor", "thumbnail"),
        "show_in_rest"       => true,
    );
    register_post_type("carte_ml", $args);
}
// Execution au démarrage du plugin.
add_action("init", "carte_init");

wp_register_style("ml-stylesheet", plugins_url("interactive-ml-map/css/ml-output.css"));
wp_register_style("ml-stylesheet-back", plugins_url("interactive-ml-map/css/ml-map-back.css"));

include('toolkit.php');
include('interactive-ml-map-initialisation-antennas.php');
include('interactive-ml-map-update-antennas.php');
include('interactive-ml-map-front.php');
include('interactive-ml-map-controller.php');
