<?php
include('templates/template-antenna-header.php');
include('templates/template-antenna-post.php');
include('templates/template-antenna-create.php');
include('templates/template-antenna-list.php');
include('templates/template-antenna-banner.php');
include('templates/template-antenna-edit.php');

// -----------------------------------------------------------------------------------------------
// Ajout du menu "Antennes" dans le back-office

function add_menu()
{
    add_menu_page("Mes antennes", "Antennes", "edit_pages", "antennas", "create_view", "dashicons-location", 6);
}

add_action("admin_menu", "add_menu");

// -----------------------------------------------------------------------------------------------
// Récupère les termes de notre taxonomie antenne

function updating_the_terms($name)
{
    return get_terms(array(
        "taxonomy" => $name,
        "hide_empty" => false,
    ));
}

function create_view()
{
    antenna_post();
    // Je récupère une liste de mes antennes 
    $terms = updating_the_terms("antenne");
    // Chargement des scripts
    wp_enqueue_style("ml-stylesheet-back");
    media_selector_print_script();
    wp_enqueue_script("script-ml-form-alert.js", plugins_url("/js/script-ml-form-alert.js", __FILE__),);
    wp_enqueue_script("script-ml-create-markers", plugins_url("/js/script-ml-create-markers.js", __FILE__),);
    wp_enqueue_media();
    antenna_header();
    // Je choisis si j'affiche un formulaire de création ou d'édition
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case 'edit':
                form_edit_antennas($terms);
                break;
            case 'create':
                form_create_antennas($terms);
                break;
            case 'remove':
                list_manage_antennas($terms);
                break;
        }
    } else {
        // J'affiche mes antennes
        list_manage_antennas($terms);
    }
}
