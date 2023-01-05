<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title">
                <?php esc_html_e('404', 'mission-locale-le-havre-estuaire-littoral'); ?>
            </h1>
        </header>
        <div class="page-content">
            <p><?php esc_html_e("Mince ! Nous n'avons rien trouvé ici... Essayez les liens ci-dessous ou faites une nouvelle recherche !", 'mission-locale-le-havre-estuaire-littoral'); ?>
            </p>
            <?php
            get_search_form();
            the_widget('WP_Widget_Recent_Posts');
            ?>
        </div>
    </section>
</main>

<?php
get_footer();