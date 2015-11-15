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
	 * Modifications to core sections and controls.
	 */

	// Set some core controls to use postMessage.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Move the Header Image control into our header section.
	$wp_customize->get_control( 'header_image' )->section = 'alcatraz_header_section';

	/**
	 * Alcatraz theme sections.
	 */

	// Layout section.
	$wp_customize->add_section(
		'alcatraz_layout_section',
		array(
			'title'      => __( 'Layout', 'alcatraz' ),
			'priority'   => 22,
			'capability' => 'edit_theme_options',
		)
	);

	// Header section.
	$wp_customize->add_section(
		'alcatraz_header_section',
		array(
			'title'      => __( 'Header', 'alcatraz' ),
			'priority'   => 90,
			'capability' => 'edit_theme_options',
		)
	);

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

	// Page layout.
	$wp_customize->add_setting(
		'alcatraz_options[page_layout]',
		array(
			'default'    => 'right-sidebar',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_page_layout_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Page Layout', 'alcatraz' ),
			'section'  => 'alcatraz_layout_section',
			'settings' => 'alcatraz_options[page_layout]',
			'choices'  => array(
				'full-width'    => __( 'Full Width', 'alcatraz' ),
				'left-sidebar'  => __( 'Left Sidebar', 'alcatraz' ),
				'right-sidebar' => __( 'Right Sidebar', 'alcatraz' ),
			),
		)
	);

	// Page Banner widget area.
	$wp_customize->add_setting(
		'alcatraz_options[page_banner_widget_area]',
		array(
			'default'    => 0,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_page_banner_widget_area_control',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Include Page Banner Widget Area?', 'alcatraz' ),
			'section'  => 'alcatraz_layout_section',
			'settings' => 'alcatraz_options[page_banner_widget_area]',
		)
	);

	// Number of footer widget areas.
	$wp_customize->add_setting(
		'alcatraz_options[footer_widget_areas]',
		array(
			'default'    => 3,
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
