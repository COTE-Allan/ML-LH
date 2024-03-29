<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

?>

<footer id="colophon" class="site-footer">
    <div class="site-footer-main">
        <div class="site-footer-socials">
            <?php
            wp_nav_menu(
                array(
                    "theme_location" => "menu-3",
                    "menu_id"        => "Réseaux sociaux du Footer",
                )
            );
            ?>
        </div>
        <?php dynamic_sidebar('footer-partners'); ?>
        <div class="site-footer-question">
            <?php
            wp_nav_menu(
                array(
                    "theme_location" => "menu-5",
                    "menu_id"        => "Gros bouton du Footer",
                )
            );
            ?>
        </div>
    </div>
    <nav class="site-footer-nav">
        <?php
        wp_nav_menu(
            array(
                "theme_location" => "menu-4",
                "menu_id"        => "Navigation du Footer",
            )
        );
        ?>
    </nav>
</footer>
</div>
<?php wp_footer(); ?>

</body>

</html>