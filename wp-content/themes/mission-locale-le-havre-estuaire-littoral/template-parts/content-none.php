<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Aucun résultat', 'mission-locale-le-havre-estuaire-littoral'); ?></h1>
    </header>

    <div class="page-content">
        <?php
		if (is_home() && current_user_can('publish_posts')) :

			printf(
				'<p>' . wp_kses(
					__('Vous souhaitez publier votre premier post ? <a href="%1$s">Commencez dès maintenant</a>.', 'mission-locale-le-havre-estuaire-littoral'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);

		elseif (is_search()) :
		?>

        <p><?php esc_html_e("Pardon, mais nous n'avons trouvé aucun résultat. Vous devriez réessayer avec des mots différents.", 'mission-locale-le-havre-estuaire-littoral'); ?>
        </p>
        <?php
			get_search_form();

		else :
		?>

        <p><?php esc_html_e("Nous ne trouvons pas ce que vous cherchez. Vous devriez faire une recherche.", 'mission-locale-le-havre-estuaire-littoral'); ?>
        </p>
        <?php
			get_search_form();

		endif;
		?>
    </div>
</section>