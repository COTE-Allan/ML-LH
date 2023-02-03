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
    <div class="site-main-content">
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
                    if ($count > 3) {
                        break;
                    }
                    the_post();
                    get_template_part('template-parts/contents', get_post_type());
                endwhile;
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
            <a href=""></a>
        </div>
        <div class="site-main-content-offers">
            <?php dynamic_sidebar('offers-placeholder'); ?>
        </div>
    </div>
    <div class="site-main-map">
        <?= do_shortcode('[sc-ml-map]');  ?>
    </div>
    <div class="site-main-proposals">
        <?php dynamic_sidebar('proposals-placeholder'); ?>
    </div>
    <div class="site-main-instagram">
        <h2 class="secondary-title"> <span class="dashicons dashicons-instagram"></span> Suivez-nous sur Instagram !
        </h2>
        <?= do_shortcode('[instagram-feed feed=1]')  ?>
    </div>
</main>



<?php
get_footer();