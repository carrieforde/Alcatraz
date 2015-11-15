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

	// Enable the custom background functionality.
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

/**
 * Utility functions.
 */
require_once ALCATRAZ_PATH . 'inc/utilities.php';

/**
 * Custom Header feature.
 */
require_once ALCATRAZ_PATH . 'inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once ALCATRAZ_PATH . 'inc/template-tags.php';

/**
 * Widget Areas.
 */
require_once ALCATRAZ_PATH . 'inc/widget-areas.php';

/**
 * Custom functions that act independently of the theme templates.
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
 * Admin-only functionality.
 */
if ( is_admin() ) {
	require_once ALCATRAZ_PATH . 'inc/admin/admin.php';
}