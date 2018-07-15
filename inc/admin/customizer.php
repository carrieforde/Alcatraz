<?php
/**
 * Alcatraz Customizer functionality.
 *
 * @package alcatraz
 */

add_action( 'customize_register', 'alcatraz_customize_register' );
/**
 * Modify the $wp_customize object.
 *
 * @since  1.0.0
 *
 * @param array $wp_customize The Customizer object.
 */
function alcatraz_customize_register( $wp_customize ) {

	/**
	 * Include our custom Customizer control types.
	 */
	if ( file_exists( ALCATRAZ_PATH . 'vendor/alpha-color-picker/alpha-color-picker.php' ) ) {
		require_once ALCATRAZ_PATH . 'vendor/alpha-color-picker/alpha-color-picker.php';
	}

	/**
	 * Modifications to core sections and controls.
	 */

	// Set some core controls to use postMessage.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Disable the Header Text Color control.
	$wp_customize->remove_control( 'header_textcolor' );

	// Rename the "Static Front Page" section to "Front Page".
	$wp_customize->get_section( 'static_front_page' )->title = __( 'Front Page', 'alcatraz' );

	/**
	 * Alcatraz theme sections.
	 */

	// Footer section.
	$wp_customize->add_section(
		'alcatraz_footer_section',
		array(
			'title'      => __( 'Footer', 'alcatraz' ),
			'priority'   => 140,
			'capability' => 'edit_theme_options',
		)
	);

	/**
	 * Alcatraz theme controls.
	 */

	/* Site Identity */

	// Hide tagline.
	$wp_customize->add_setting(
		'hide_tagline',
		array(
			'default'           => false,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'alcatraz_validate_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hide_tagline',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Hide the site description?', 'alcatraz' ),
			'section' => 'title_tagline',
		)
	);

	/* Footer */

	// Number of footer widget areas.
	$wp_customize->add_setting(
		'footer_widget_areas',
		array(
			'default'           => 3,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'footer_widget_areas',
		array(
			'type'    => 'select',
			'label'   => __( 'Number of Footer Widget Areas', 'alcatraz' ),
			'section' => 'alcatraz_footer_section',
			'choices' => array(
				0 => __( 'None', 'alcatraz' ),
				1 => __( '1', 'alcatraz' ),
				2 => __( '2', 'alcatraz' ),
				3 => __( '3', 'alcatraz' ),
				4 => __( '4', 'alcatraz' ),
			),
		)
	);

	// Footer bottom.
	$wp_customize->add_setting(
		'footer_credits',
		array(
			'default'               => '',
			'type'                  => 'theme_mod',
			'capability'            => 'edit_theme_options',
			'sanitization_callback' => 'wp_filter_post_kses',
		)
	);
	$wp_customize->add_control(
		'footer_credits',
		array(
			'type'    => 'textarea',
			'label'   => __( 'Footer Credits Content', 'alcatraz' ),
			'section' => 'alcatraz_footer_section',
		)
	);

	// Social network icons.
	$wp_customize->add_setting(
		'social_icons_in_footer',
		array(
			'default'           => false,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'alcatraz_validate_checkbox',
		)
	);
	$wp_customize->add_control(
		'social_icons_in_footer',
		array(
			'type'    => 'checkbox',
			'label'   => __( 'Show Social Icons in Footer?', 'alcatraz' ),
			'section' => 'alcatraz_footer_section',
		)
	);
}

add_action( 'customize_preview_init', 'alcatraz_customize_preview_js' );
/**
 * Enqueue our customizer JS.
 *
 * @since  1.0.0
 */
function alcatraz_customize_preview_js() {
	wp_enqueue_script(
		'alcatraz_customizer',
		ALCATRAZ_URL . 'dist/customizer-bundle.js',
		array( 'customize-preview' ),
		ALCATRAZ_VERSION,
		true
	);
}
