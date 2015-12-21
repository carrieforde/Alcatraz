<?php
/**
 * Alcatraz functions and definitions.
 *
 * @package alcatraz
 */

define( 'ALCATRAZ_VERSION', '1.0.0' );
define( 'ALCATRAZ_PATH', trailingslashit( get_template_directory() ) );
define( 'ALCATRAZ_URL', trailingslashit( get_template_directory_uri() ) );

add_action( 'after_switch_theme', 'alcatraz_first_setup' );
/**
 * Check for our theme options and set defaults for any options that don't already exist.
 *
 * This only runs one time right after the user activates the theme.
 *
 * @since  1.0.0
 */
function alcatraz_first_setup() {

	// Look for existing options.
	$options = get_option( 'alcatraz_options' );

	if ( ! $options ) {
		$options = array();
	}

	$defaults = alcatraz_get_option_defaults();

	// Bail early if the existing options match the defaults.
	if ( $options === $defaults ) {
		return;
	}

	// Populate any defaults that are missing.
	foreach ( $defaults as $key => $value ) {
		if ( ! array_key_exists( $key, $options ) ) {
			$options[ $key ] = $value;
		}
	}

	// Update options with defaults.
	update_option( 'alcatraz_options', $options, 'yes' );
}

add_action( 'after_setup_theme', 'alcatraz_setup', 0 );
/**
 * Load translations and register support for various WordPress features.
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
	if ( apply_filters( 'alcatraz_enable_custom_background', false ) ) {
		add_theme_support(
			'custom-background',
			apply_filters( 'alcatraz_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) )
		);
	}
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

add_action( 'after_setup_theme', 'alcatraz_register_image_sizes', 0 );
/**
 * Register our theme image sizes.
 *
 * @since  1.0.0
 */
function alcatraz_register_image_sizes() {
	set_post_thumbnail_size( 1200, 740, true );
}

add_action( 'after_setup_theme', 'alcatraz_google_fonts', 0 );
/**
 * Define our theme Google fonts
 *
 * @since  1.0.0
 */
function alcatraz_google_fonts() {

	$google_fonts = '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,700|Source+Code+Pro|Source+Serif+Pro:400,600,700';
	$google_fonts = apply_filters( 'alcatraz_google_fonts', $google_fonts );

	$GLOBALS['alcatraz_google_fonts'] = str_replace( ',', '%2C', $google_fonts );
}

add_action( 'wp_enqueue_scripts', 'alcatraz_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function alcatraz_scripts() {

	global $alcatraz_google_fonts;

	// Google fonts.
	wp_enqueue_style(
		'alcatraz-fonts',
		$alcatraz_google_fonts,
		array(),
		ALCATRAZ_VERSION
	);

	// Main theme CSS.
	wp_enqueue_style(
		'alcatraz-style',
		get_stylesheet_uri(),
		array(),
		ALCATRAZ_VERSION
	);

	// Skip link focus fix JS.
	wp_register_script(
		'alcatraz-skip-link-focus-fix',
		ALCATRAZ_URL . 'js/src/skip-link-focus-fix.js',
		array(),
		ALCATRAZ_VERSION,
		true
	);

	// Custom jQuery mobile build (mostly for touch events).
	wp_register_script(
		'alcatraz-jquery-mobile',
		ALCATRAZ_URL . 'lib/jquery-mobile/jquery.mobile.custom.min.js',
		array( 'jquery' ),
		ALCATRAZ_VERSION,
		true
	);

	// Navigation JS.
	wp_register_script(
		'alcatraz-navigation',
		ALCATRAZ_URL . 'js/src/navigation.js',
		array( 'jquery', 'alcatraz-jquery-mobile' ),
		ALCATRAZ_VERSION,
		true
	);

	// Main theme JS.
	wp_enqueue_script(
		'alcatraz-scripts',
		ALCATRAZ_URL . 'js/alcatraz-theme.min.js',
		array( 'jquery' ),
		ALCATRAZ_VERSION,
		true
	);

	// Comment reply JS.
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
 * Ajax callbacks.
 */
require_once ALCATRAZ_PATH . 'inc/ajax.php';

/**
 * Custom template tags for this theme.
 */
require_once ALCATRAZ_PATH . 'inc/template-tags.php';

/**
 * Option choices.
 */
require_once ALCATRAZ_PATH . 'inc/theme-options.php';

/**
 * Theme hook output.
 */
require_once ALCATRAZ_PATH . 'inc/theme-hooks.php';

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
