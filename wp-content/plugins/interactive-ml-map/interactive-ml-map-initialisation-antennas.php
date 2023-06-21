<?php

// -----------------------------------------------------------------------------------------------
// Création de la taxonomie antenne dans le back-office.

function antenna_taxonomy()
{
    $labels = array(
        "name"              => _x("Ajouter une nouvelle antenne", "taxonomy general name", "textdomain"),
        "singular_name"     => _x("Antenne", "taxonomy singular name", "textdomain"),
        "search_items"      => __("Rechercher une antenne", "textdomain"),
        "all_items"         => __("Toutes les Antennes", "textdomain"),
        "parent_item"       => __("Parent Antenne", "textdomain"),
        "parent_item_colon" => __("Parent Antenne:", "textdomain"),
        "edit_item"         => __("Modifier une Antenne", "textdomain"),
        "update_item"       => __("Mettre à jour l'antenne", "textdomain"),
        "new_item_name"     => __("New Antenne Name", "textdomain"),
        "menu_name"         => __("Antenne", "textdomain"),
    );
    $args = array(
        "hierarchical"      => true,
        "labels"            => $labels,
        "show_ui"           => false,
        "show_admin_column" => false,
        "query_var"         => true,
        "rewrite"           => array("slug" => "antenne"),
        "show_in_rest"       => true,
    );
    register_taxonomy("antenne", array("carte_ml"), $args);
}
add_action("init", "antenna_taxonomy");

// -----------------------------------------------------------------------------------------------
// Enregistrement des métas supplémentaires dans le JSON.

function antenna_meta()
{
    register_term_meta("antenne", "ml-adress", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "ml-phone", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "ml-link", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "image-attachment-url", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "ml-longitude", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "ml-latitude", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "ml-opening", array(
        "show_in_rest" => true
    ));
    register_term_meta("antenne", "ml-opening-check", array(
        "show_in_rest" => true
    ));
}

add_action("init", "antenna_meta");