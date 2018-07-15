<?php
/**
 * Alcatraz functions and definitions.
 *
 * @package alcatraz
 */

define( 'ALCATRAZ_VERSION', '1.0.0' );
define( 'ALCATRAZ_PATH', trailingslashit( get_template_directory() ) );
define( 'ALCATRAZ_URL', trailingslashit( get_template_directory_uri() ) );

if ( ! function_exists( 'alcatraz_setup' ) ) :
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

		// Enable support for a custom logo.
		add_theme_support( 'custom-logo' );

		// Register menus.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'alcatraz' ),
			'social' => esc_html__( 'Social', 'alcatraz' ),
		) );

		// Use html5 markup for certain features.
		add_theme_support(
			'html5',
			apply_filters( 'alcatraz_html5_supports', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) )
		);

		// Maybe enable post formats.
		if ( apply_filters( 'alcatraz_enable_post_formats', false ) ) {
			add_theme_support(
				'post-formats',
				apply_filters( 'alcatraz_custom_header_args', array(
					'aside',
					'image',
					'video',
					'quote',
					'link',
				) )
			);
		}

		// Maybe enable the custom header feature.
		if ( apply_filters( 'alcatraz_enable_custom_header', false ) ) {
			add_theme_support(
				'custom-header',
				apply_filters( 'alcatraz_custom_header_args', array(
					'default-image'      => '',
					'default-text-color' => '000000',
					'width'              => 1200,
					'height'             => 320,
					'flex-height'        => true,
				) )
			);
		}

		// Maybe enable the custom background feature.
		if ( apply_filters( 'alcatraz_enable_custom_background', false ) ) {
			add_theme_support(
				'custom-background',
				apply_filters( 'alcatraz_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				) )
			);
		}

		// Add support for editor color palette.
		add_theme_support( 'editor-color-palette',
			array(
				'name'  => 'bay-of-many',
				'color' => '#1f4483',
			),
			array(
				'name'  => 'puerto-rico',
				'color' => '#58b7a1',
			),
			array(
				'name'  => 'mine-shaft',
				'color' => '#363a42',
			),
			array(
				'name'  => 'raven',
				'color' => '#73767b',
			),
			array(
				'name'  => 'white',
				'color' => '#fff',
			)
		);

		// Disable custom colors from editor palette.
		add_theme_support( 'disable-custom-colors' );
	}
endif;

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

add_action( 'wp_enqueue_scripts', 'alcatraz_scripts' );
/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function alcatraz_scripts() {

	$current_theme = wp_get_theme();

	// Theme header CSS.
	if ( is_admin() ) {
		wp_enqueue_style(
			'alcatraz-style',
			ALCATRAZ_URL . 'style.css',
			array(),
			ALCATRAZ_VERSION
		);
	}

	// Main theme CSS.
	wp_register_style(
		'alcatraz-style',
		ALCATRAZ_URL . 'dist/main.css',
		array(),
		ALCATRAZ_VERSION
	);

	// Main theme JS.
	wp_register_script(
		'alcatraz-scripts',
		ALCATRAZ_URL . 'dist/frontend-bundle.js',
		array( 'jquery' ),
		ALCATRAZ_VERSION,
		true
	);

	// Enqueue the JS always.
	wp_enqueue_script( 'alcatraz-scripts' );

	// Enqueue the CSS and fonts only if a child theme is not being used.
	if ( 'Alcatraz' === $current_theme->get( 'Name' ) ) {
		wp_enqueue_style( 'alcatraz-fonts' );
		wp_enqueue_style( 'alcatraz-style' );
	}

	// Translatable strings and other data for our JS.
	$vars = array(
		'menu_toggle'    => __( 'Toggle', 'alcatraz' ),
		'menu_close'     => __( 'Close', 'alcatraz' ),
		'slide_duration' => 300,
	);
	$vars = apply_filters( 'alcatraz_js_vars', $vars );

	wp_localize_script( 'alcatraz-scripts', 'alcatraz_vars', $vars );

	// Comment reply JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
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
 * Theme options.
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
 * Admin-only functionality.
 */
if ( is_admin() ) {
	require_once ALCATRAZ_PATH . 'inc/admin/admin.php';
}
