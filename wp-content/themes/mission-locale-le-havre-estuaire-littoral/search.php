<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

get_header();
?>
<div class="site-content">

    <main id="primary" class="site-main site-search">

        <?php if (have_posts()) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
					/* translators: %s: search query. */
					printf(esc_html__('Résultats pour: %s', 'mission-locale-le-havre-estuaire-littoral'), '<span>' . get_search_query() . '</span>');
					?>
            </h1>
        </header><!-- .page-header -->
        <div class="site-search-result">
            <?php
				/* Start the Loop */
				while (have_posts()) :

					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
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