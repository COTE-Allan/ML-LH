<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e("Skip to content", "mission-locale-le-havre-estuaire-littoral"); ?></a>

        <header id="masthead" class="site-header">

            <div class="site-header-main">
                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    ?>
                    <span class="dashicons dashicons-menu-alt2 mobile-open-menu"></span>
                </div>
                <nav class="main-navigation site-header-nav">
                    <?php
                    wp_nav_menu(
                        array(
                            "theme_location" => "menu-1",
                            "menu_id"        => "Navigation du header",
                            "menu_class"     => "ml-dropdown-menu"
                        )
                    );
                    ?>
                </nav>
            </div>
            <div class="main-navigation site-header-menu">
                <?php
                get_search_form();
                wp_nav_menu(
                    array(
                        "theme_location" => "menu-2",
                        "menu_id"        => "Blocs de couleurs du Header",
                        "menu_class"     => "ml-blocs-menu"
                    )
                );
                ?>
            </div>
        </header>

        <script>
            let burger = document.querySelector(".mobile-open-menu");
            let menus = document.querySelectorAll(".main-navigation");
            burger.addEventListener("click", (event) => {
                burger.classList.toggle("dashicons-menu-alt2")
                burger.classList.toggle("dashicons-no-alt")
                menus.forEach(menu => {
                    menu.classList.toggle("open")
                });
            });
        </script>