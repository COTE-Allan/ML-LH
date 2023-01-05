<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

?>

<!-- #post-<?php the_ID(); ?> -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php mission_locale_le_havre_estuaire_littoral_post_thumbnail(); ?>

        <?php
        the_title('<h1 class="entry-title">', '</h1>');


        if ('post' === get_post_type()) :
        ?>
        <div class="entry-meta">
            <?php
                mission_locale_le_havre_estuaire_littoral_posted_on();
                ?>
        </div>
        <?php endif; ?>
    </header>


    <div class="entry-content">
        <?php
        the_excerpt();
        ?>
    </div>

</article>