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

	// Set some core controls to use postMessage.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Layout section.
	$wp_customize->add_section(
		'alcatraz_layout_section',
		array(
			'title'      => __( 'Layout', 'alcatraz' ),
			'priority'   => 22,
			'capability' => 'edit_theme_options',
		)
	);

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
			'type'      => 'radio',
			'label'     => __( 'Page Layout', 'alcatraz' ),
			'section'   => 'alcatraz_layout_section',
			'settings'  => 'alcatraz_options[page_layout]',
			'choices'   => array(
				'full-width'    => __( 'Full Width', 'alcatraz' ),
				'left-sidebar'  => __( 'Left Sidebar', 'alcatraz' ),
				'right-sidebar' => __( 'Right Sidebar', 'alcatraz' ),
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
