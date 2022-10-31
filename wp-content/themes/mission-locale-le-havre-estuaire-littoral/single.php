<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

get_header();
?>
<?php
if (function_exists('yoast_breadcrumb')) {
	yoast_breadcrumb('
<p id="breadcrumbs">', '</p>
');
}
?>
<div class="site-single-banner">

    <div class="site-single-banner-content">
        <h1>
            <?php
			the_title();
			?>
        </h1>
        <div class="site-single-banner-content-details">
            <?php
			the_category("-");
			echo ' / ';
			echo get_the_date('j F, Y');
			?>
        </div>
    </div>
    <div class="site-single-banner-background">
        <?php
		the_post_thumbnail();
		?>
    </div>
</div>
<div class="site-content">

    <main id="primary" class="site-main site-single">

        <?php
		while (have_posts()) :
			the_post();
		?>

        <?php
			get_template_part('template-parts/content', get_post_type());

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'mission-locale-le-havre-estuaire-littoral') . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'mission-locale-le-havre-estuaire-littoral') . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    </main><!-- #main -->
    <?php
	get_sidebar();
	?>

</div>
<?php
get_footer();