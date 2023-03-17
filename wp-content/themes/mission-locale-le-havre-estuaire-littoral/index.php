<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

get_header();
?>
<main id="primary" class="site-main">
    <?php
    echo do_shortcode('[smartslider3 slider="3"]');
    ?>
    <section class="site-main-content home-section">
        <div class="site-main-content-news">
            <h2>Actualités</h2>
            <hr />
            <?php
            $count = 0; //set up counter variable
            if (have_posts()) :

                if (is_home() && !is_front_page()) :
            ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
            <?php
                endif;
                while (have_posts()) :
                    $count++; //increment the variable by 1 each time the loop executes
                    if ($count > 1) {
                        if ($count > 3) {
                            break;
                        }
                        the_post();
                        get_template_part('template-parts/contents-secondary', get_post_type());
                    } else {
                        the_post();
                        get_template_part('template-parts/contents', get_post_type());
                    }
                endwhile;
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
        </div>
        <div class="site-main-content-offers">
            <?php dynamic_sidebar('offers-placeholder'); ?>
        </div>
    </section>
    <div class="site-main-map">
        <?= do_shortcode('[sc-ml-map]');  ?>
        <section class="site-main-proposals home-section">
            <?php dynamic_sidebar('proposals-placeholder'); ?>
        </section>
    </div>
    <section class="site-main-instagram home-section">
        <h2 class="secondary-title"> <span class="dashicons dashicons-instagram"></span> Suivez-nous sur Instagram !
        </h2>
        <?= do_shortcode('[instagram-feed feed=1]')  ?>
    </section>
</main>



<?php
get_footer();
