<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

get_header();
?>
<div class="site-content">
    <main id="primary" class="site-main site-search">
        <?php if (have_posts()) : ?>
        <header class="page-header">
            <?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
        </header>
        <div class="site-search-result">

            <?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/content', 'search');
				endwhile;
				the_posts_navigation();
				?>
        </div>
        <?php
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
    </main>
    <?php
	get_sidebar();
	?>
</div>
<?php
get_footer();