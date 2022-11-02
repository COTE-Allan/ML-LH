<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

			get_template_part('template-parts/content', 'page');

		endwhile; // End of the loop.
		?>
        <hr class="site-content-separate" />

    </main><!-- #main -->
    <?php
	get_sidebar();
	?>

</div>
<?php
get_footer();