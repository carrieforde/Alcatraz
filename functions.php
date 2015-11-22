<?php
/**
 * Alcatraz functions and definitions.
 *
 * @package alcatraz
 */

define( 'ALCATRAZ_VERSION', '1.0.0' );
define( 'ALCATRAZ_PATH', trailingslashit( get_template_directory() ) );
define( 'ALCATRAZ_URL', trailingslashit( get_template_directory_uri() ) );

add_action( 'after_setup_theme', 'alcatraz_setup' );
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * @since  1.0.0
 */
function alcatraz_setup() {

	// Load translation files.
	load_theme_textdomain( 'alcatraz', ALCATRAZ_PATH . 'languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress generate our title tags.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register a primary menu.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'alcatraz' ),
	) );

	// Use html5 markup for certain features.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Maybe enable post formats.
	if ( apply_filters( 'alcatraz_enable_post_formats', false ) ) {
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );
	}

	// Enable the custom header feature.
	add_theme_support(
		'custom-header',
		apply_filters( 'alcatraz_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '000000',
			'width'                  => 1200,
			'height'                 => 320,
			'flex-height'            => true,
		)
	) );

	// Enable the custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters( 'alcatraz_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) )
	);
}

add_action( 'after_setup_theme', 'alcatraz_content_width', 0 );
/**
 * Set the content width.
 *
 * @since   1.0.0
 * @global  int  $content_width
 */
function alcatraz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'alcatraz_content_width', 640 );
}

add_action( 'wp_enqueue_scripts', 'alcatraz_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function alcatraz_scripts() {
	wp_enqueue_style(
		'alcatraz-style',
		get_stylesheet_uri(),
		array(),
		ALCATRAZ_VERSION
	);

	wp_enqueue_script(
		'alcatraz-navigation',
		ALCATRAZ_URL . 'js/navigation.js',
		array(),
		ALCATRAZ_VERSION,
		true
	);

	wp_enqueue_script(
		'alcatraz-skip-link-focus-fix',
		ALCATRAZ_URL . 'js/skip-link-focus-fix.js',
		array(),
		ALCATRAZ_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'init', 'alcatraz_init_bfa' );
/**
 * Include and initialize the Better Font Awesome Library.
 *
 * @since  1.0.0
 */
function alcatraz_init_bfa() {

	$args = array(
		'version'             => 'latest',
		'minified'            => true,
		'remove_existing_fa'  => false,
		'load_styles'         => true,
		'load_admin_styles'   => true,
		'load_shortcode'      => true,
		'load_tinymce_plugin' => true,
	);

	Better_Font_Awesome_Library::get_instance( $args );
}

/**
 * Utility functions.
 */
require_once ALCATRAZ_PATH . 'inc/utilities.php';

/**
 * Option choices.
 */
require_once ALCATRAZ_PATH . 'inc/choices.php';

/**
 * Custom template tags for this theme.
 */
require_once ALCATRAZ_PATH . 'inc/template-tags.php';

/**
 * Widget Areas.
 */
require_once ALCATRAZ_PATH . 'inc/widget-areas.php';

/**
 * Custom functions that act independent of the theme templates.
 */
require_once ALCATRAZ_PATH . 'inc/extras.php';

/**
 * Customizer additions.
 */
require_once ALCATRAZ_PATH . 'inc/admin/customizer.php';

/**
 * Jetpack compatibility file.
 */
require_once ALCATRAZ_PATH . 'inc/jetpack.php';

/**
 * Better Font Awesome Library.
 */
require_once ALCATRAZ_PATH . 'lib/better-font-awesome-library/better-font-awesome-library.php';

/**
 * Admin-only functionality.
 */
if ( is_admin() ) {
	require_once ALCATRAZ_PATH . 'inc/admin/admin.php';
}