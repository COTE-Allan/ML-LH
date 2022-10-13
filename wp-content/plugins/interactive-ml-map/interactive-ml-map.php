<?php
/*
Plugin Name: Carte interactive de la Mission Locale
Plugin URI: https://ml-lehavre.fr/
Description: Un plugin conçu pour afficher une carte interactive des antennes de la Mission Locale Le Havre Estuaire Littoral.
Author: Julien Richard 
Version: 1.0
*/


// Création du menu dans le back-office wordpress
function map_post_type()
{
    $labels = array(
        "name" => "Carte",
        "all_items" => "Tous les emplacements",
        "add_new_item" => "Ajouter un emplacement",
        "edit_item" => "Modifier l'emplacement",
        "menu_name" => "Carte Interactive"
    );
    $args = array(
        "labels" => $labels,
        "public" => true,
        "show_in_rest" => true,
        "supports" => array("title", "editor", "thumbnail"),
        "menu_position" => 5,
        "menu_icon" => "dashicons-location",
    );
    register_post_type("map", $args);
}
// Execution au démarrage du plugin
add_action("init", "map_post_type");