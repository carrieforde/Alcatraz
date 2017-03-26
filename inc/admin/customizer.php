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
 */
function alcatraz_customize_register( $wp_customize ) {

	/**
	 * Get the default values for our options.
	 */
	$option_defaults = alcatraz_get_option_defaults();

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
	 
	/* Footer */

	// Number of footer widget areas.
	$wp_customize->add_setting(
		'alcatraz_options[footer_widget_areas]',
		array(
			'default'    => $option_defaults['footer_widget_areas'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_footer_widget_areas_control',
		array(
			'type'     => 'select',
			'label'    => __( 'Number of Footer Widget Areas', 'alcatraz' ),
			'section'  => 'alcatraz_footer_section',
			'settings' => 'alcatraz_options[footer_widget_areas]',
			'choices'  => array(
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
		'alcatraz_options[footer_bottom]',
		array(
			'default'    => $option_defaults['footer_bottom'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_footer_bottom_control',
		array(
			'type'     => 'textarea',
			'label'    => __( 'Footer Bottom Content', 'alcatraz' ),
			'section'  => 'alcatraz_footer_section',
			'settings' => 'alcatraz_options[footer_bottom]',
		)
	);

	// Social network icons.
	$wp_customize->add_setting(
		'alcatraz_options[social_icons_in_footer]',
		array(
			'default'           => $option_defaults['social_icons_in_footer'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_social_icons_in_footer_control',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Show Social Icons in Footer?', 'alcatraz' ),
			'section'  => 'alcatraz_footer_section',
			'settings' => 'alcatraz_options[social_icons_in_footer]',
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
		ALCATRAZ_URL . 'js/customizer.js',
		array( 'customize-preview' ),
		ALCATRAZ_VERSION,
		true
	);
}
