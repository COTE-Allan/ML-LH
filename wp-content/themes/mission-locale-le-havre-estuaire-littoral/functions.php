<?php

/**
 * Mission Locale Le Havre Estuaire Littoral functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mission_Locale_Le_Havre_Estuaire_Littoral
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mission_locale_le_havre_estuaire_littoral_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Mission Locale Le Havre Estuaire Littoral, use a find and replace
		* to change 'mission-locale-le-havre-estuaire-littoral' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('mission-locale-le-havre-estuaire-littoral', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => "Navigation du Header",
			'menu-2' => "Blocs de couleurs du Header",
			'menu-3' => "Réseaux sociaux du Footer",
			'menu-4' => "Navigation du Footer",
			'menu-5' => "Gros bouton du Footer",

		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'mission_locale_le_havre_estuaire_littoral_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'mission_locale_le_havre_estuaire_littoral_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mission_locale_le_havre_estuaire_littoral_content_width()
{
	$GLOBALS['content_width'] = apply_filters('mission_locale_le_havre_estuaire_littoral_content_width', 640);
}
add_action('after_setup_theme', 'mission_locale_le_havre_estuaire_littoral_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mission_locale_le_havre_estuaire_littoral_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar ML', 'mission-locale-le-havre-estuaire-littoral'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Sidebar des pages.', 'mission-locale-le-havre-estuaire-littoral'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Partenaires', 'mission-locale-le-havre-estuaire-littoral'),
			'id'            => 'footer-partners',
			'description'   => esc_html__('Ajouter le bandeau partenaire ici.', 'mission-locale-le-havre-estuaire-littoral'),
			'before_widget' => '<div class="site-footer-partners">',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Emplacement offres', 'mission-locale-le-havre-estuaire-littoral'),
			'id'            => 'offers-placeholder',
			'description'   => esc_html__('Ajouter les redirections vers les offres ici.', 'mission-locale-le-havre-estuaire-littoral'),
			'before_widget' => '<div class="offers-item">',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Emplacement dispositifs', 'mission-locale-le-havre-estuaire-littoral'),
			'id'            => 'proposals-placeholder',
			'description'   => esc_html__('Ajouter les dispositifs de la ML ici.', 'mission-locale-le-havre-estuaire-littoral'),
			'before_widget' => '<div class="proposals-item">',
			'after_widget'  => '</div>',
		)
	);
}
add_action('widgets_init', 'mission_locale_le_havre_estuaire_littoral_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function mission_locale_le_havre_estuaire_littoral_scripts()
{
	wp_enqueue_style('mission-locale-le-havre-estuaire-littoral-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('mission-locale-le-havre-estuaire-littoral-style', 'rtl', 'replace');

	wp_enqueue_script('mission-locale-le-havre-estuaire-littoral-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'mission_locale_le_havre_estuaire_littoral_scripts');


//Enqueue the Dashicons script
add_action('wp_enqueue_scripts', 'load_dashicons_front_end');
function load_dashicons_front_end()
{
	wp_enqueue_style('dashicons');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more)
{
	global $post;
	return ' [...] <a class="moretag" href="' . get_permalink($post->ID) . '"> Lire la suite...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Le premier post aura une classe supplémentaire.
function firstpost_class($class)
{
	global $post, $posts;
	if (is_home() && !is_paged() && ($post == $posts[0])) $class[] = 'firstpost';
	return $class;
}
add_filter('post_class', 'firstpost_class');


//Changement de taille max de l'extrait.
function my_excerpt_length($length)
{
	return 45;
}
add_filter('excerpt_length', 'my_excerpt_length');



add_filter('submit_job_form_fields', 'custom_submit_job_form_fields_dm');
function custom_submit_job_form_fields_dm($fields)
{
	unset($fields['account']['logged_in']);
	unset($fields['company']['company_website']);
	unset($fields['company']['company_video']);
	unset($fields['company']['company_tagline']);
	unset($fields['company']['company_twitter']);
	unset($fields['company']['company_logo']);



	// And return the modified fields
	return $fields;
}


add_filter('job_manager_job_dashboard_columns', 'custom_job_manager_job_dashboard_columns');
function custom_job_manager_job_dashboard_columns($columns)
{


	// Add columns with proper headings in the correct order.
	$columns['candidat'] = 'Mail de candidature';
	$columns['company'] = 'Entreprise';

	// Return.
	return $columns;
}