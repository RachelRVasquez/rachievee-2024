<?php

/**
 * RachieVee 2024 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RachieVee_2024
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

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
function rachievee_2024_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on RachieVee 2024, use a find and replace
		* to change 'rachievee-2024' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('rachievee-2024', get_template_directory() . '/languages');

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
			'menu-1' => esc_html__('Primary', 'rachievee-2024'), //main menu
			// 'menu-2' => esc_html__('Secondary', 'rachievee-2024'), //social icons header
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
			'rachievee_2024_custom_background_args',
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
add_action('after_setup_theme', 'rachievee_2024_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rachievee_2024_content_width()
{
	$GLOBALS['content_width'] = apply_filters('rachievee_2024_content_width', 640);
}
add_action('after_setup_theme', 'rachievee_2024_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rachievee_2024_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'rachievee-2024'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'rachievee-2024'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'rachievee_2024_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function rachievee_2024_scripts()
{
	wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Oleo+Script+Swash+Caps:wght@400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap', array(), null);
	wp_enqueue_style('google-fonts');

    wp_enqueue_style( 'rachievee-2024-font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/all.min.css' );

	wp_enqueue_style('rachievee-2024-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('rachievee-2024-style', 'rtl', 'replace');

	wp_enqueue_script('rachievee-2024-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'rachievee_2024_scripts');

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

/**
 * Carbon Fields
 */
add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options()
{
	Container::make('theme_options', __('Theme Options', 'rachievee-2024'))
		->add_fields(array(
			Field::make('text', 'homepage_hero_title', 'Hero Title'),
			Field::make('text', 'homepage_hero_subtitle', 'Hero Subtitle'),
			Field::make('rich_text', 'homepage_hero_desc', 'Hero Description'),
		));
}

add_action('after_setup_theme', 'crb_load');

function crb_load()
{
	require_once('vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}


//filter users by role in delete user dropdown
add_action('pre_user_query',  'filter_users_by_isda_when_deleting');

function filter_users_by_isda_when_deleting( $query )
{
	if ( function_exists( 'get_current_screen' ) ) {
		$current_screen = get_current_screen();

		if ( $current_screen->id === 'users' && isset( $_GET['action'] ) && $_GET['action'] === 'delete' ) {
			global $wpdb;
			$selected_user_id = $_GET['user'];
			$query->query_where = str_replace('WHERE 1=1 AND wp_users.ID NOT IN (' . $selected_user_id . ')', "WHERE 1=1 AND {$wpdb->users}.ID IN (
					SELECT DISTINCT wpu.ID FROM {$wpdb->users} wpu
					JOIN {$wpdb->usermeta} wpum
					ON (wpu.ID = wpum.user_id)
						WHERE wpum.meta_key = 'wp_capabilities' AND wpum.meta_value LIKE '%administrator%'
						AND ( wpu.ID NOT IN ($selected_user_id )) )", $query->query_where);
		}
	}

	return $query;
}
