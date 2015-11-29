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
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Move the Header Image control to the bottom of our header section.
	$wp_customize->get_control( 'header_image' )->section  = 'alcatraz_header_section';
	$wp_customize->get_control( 'header_image' )->priority = 120;

	// Disable the Header Text Color control.
	$wp_customize->remove_control( 'header_textcolor' );

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

	// Site Logo.
	$wp_customize->add_section(
		'alcatraz_logo_section',
		array(
			'title'       => __( 'Logo', 'alcatraz' ),
			'priority'    => 30,
			'description' => 'Upload a logo to replace the default site name and description in the header',
		)
	);

	$wp_customize->add_setting( 'alcatraz_logo' );

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'alcatraz_logo',
			array(
				'label'    => __( 'Logo', 'alcatraz' ),
				'section'  => 'alcatraz_logo_section',
				'settings' => 'alcatraz_logo',
			)
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

	// Site layout.
	$wp_customize->add_setting(
		'alcatraz_options[site_layout]',
		array(
			'default'    => 'full-width',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_site_layout_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Site Layout', 'alcatraz' ),
			'section'  => 'alcatraz_layout_section',
			'settings' => 'alcatraz_options[site_layout]',
			'choices'  => array(
				'full-width' => __( 'Full Width', 'alcatraz' ),
				'boxed'      => __( 'Boxed', 'alcatraz' ),
			),
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
			'type'     => 'radio',
			'label'    => __( 'Page Layout', 'alcatraz' ),
			'section'  => 'alcatraz_layout_section',
			'settings' => 'alcatraz_options[page_layout]',
			'choices'  => array(
				'no-sidebar'    => __( 'No Sidebar', 'alcatraz' ),
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

	// Header style.
	$wp_customize->add_setting(
		'alcatraz_options[header_style]',
		array(
			'default'    => 'default',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_header_style_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Header Style', 'alcatraz' ),
			'section'  => 'alcatraz_header_section',
			'settings' => 'alcatraz_options[header_style]',
			'choices'  => array(
				'default' => __( 'Default', 'alcatraz' ),
				'short'   => __( 'Short', 'alcatraz' ),
				'side'    => __( 'Side', 'alcatraz' ),
			),
		)
	);

	// Mobile navigation toggle style.
	$wp_customize->add_setting(
		'alcatraz_options[mobile_nav_toggle_style]',
		array(
			'default'    => 'button',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_mobile_nav_toggle_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Mobile Navigation Toggle Style', 'alcatraz' ),
			'section'  => 'alcatraz_header_section',
			'settings' => 'alcatraz_options[mobile_nav_toggle_style]',
			'choices'  => alcatraz_get_mobile_nav_toggle_options( 'header' ),
		)
	);

	// Mobile navigation style.
	$wp_customize->add_setting(
		'alcatraz_options[mobile_nav_style]',
		array(
			'default'    => 'default',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_mobile_nav_style_control',
		array(
			'type'     => 'select',
			'label'    => __( 'Mobile Navigation Style', 'alcatraz' ),
			'section'  => 'alcatraz_header_section',
			'settings' => 'alcatraz_options[mobile_nav_style]',
			'choices'  => array(
				'default' => __( 'Default', 'alcatraz' ),
				'from-left' => __( 'Slide from Left', 'alcatraz' ),
				'from-right' => __( 'Slide from Right', 'alcatraz' ),
				'full-screen' => __( 'Full Screen', 'alcatraz' ),
				'fade-in'     => __( 'Fade In', 'alcatraz' ),
			),
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

	// Footer bottom.
	$wp_customize->add_setting(
		'alcatraz_options[footer_bottom]',
		array(
			'default'    => '',
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
