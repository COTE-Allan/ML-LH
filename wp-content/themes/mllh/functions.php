<?php
function my_excerpt_length($length)
{
    return 20;
}
wp_enqueue_style('style', get_stylesheet_uri());
// Après initialisation du thème :
add_action("after_setup_theme", function () {
    // Ajout d'une balise Title dans le head
    add_theme_support("title-tag");
    // Ajout du support pour les bannières de posts
    add_theme_support('post-thumbnails');
    // Réduit la limite des textes de prévisuliation
    add_filter("excerpt_length", "my_excerpt_length");
});
