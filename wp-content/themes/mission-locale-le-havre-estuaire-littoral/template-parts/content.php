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
    <?php mission_locale_le_havre_estuaire_littoral_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
		the_content(
			sprintf(
				wp_kses(
					__('Lire la suite...<span class="screen-reader-text"> "%s"</span>', 'mission-locale-le-havre-estuaire-littoral'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);
		?>
        <?php
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__('Article précédent:', 'mission-locale-le-havre-estuaire-littoral') . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__('Article suivant:', 'mission-locale-le-havre-estuaire-littoral') . '</span> <span class="nav-title">%title</span>',
			)
		);
		?>
    </div>
</article>