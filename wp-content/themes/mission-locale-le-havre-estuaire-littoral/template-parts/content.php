<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php mission_locale_le_havre_estuaire_littoral_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'mission-locale-le-havre-estuaire-littoral'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'mission-locale-le-havre-estuaire-littoral'),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php mission_locale_le_havre_estuaire_littoral_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->