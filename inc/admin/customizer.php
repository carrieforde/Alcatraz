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
	 * Include our custom Customizer control types.
	 */
	if ( file_exists( ALCATRAZ_PATH . 'vendor/alpha-color-picker/alpha-color-picker.php' ) ) {
		require_once ALCATRAZ_PATH . 'vendor/alpha-color-picker/alpha-color-picker.php';
	}

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

	// Menu Options section.
	$wp_customize->add_section(
		'alcatraz_menu_options_section',
		array(
			'title'      => __( 'Menu Options', 'alcatraz' ),
			'priority'   => 5,
			'panel'      => 'nav_menus',
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

	/* Layout */

	// Site layout.
	$wp_customize->add_setting(
		'alcatraz_options[site_layout]',
		array(
			'default'    => $option_defaults['site_layout'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'alcatraz_site_layout_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Site Layout', 'alcatraz' ),
			'section'  => 'alcatraz_layout_section',
			'settings' => 'alcatraz_options[site_layout]',
			'choices'  => alcatraz_get_site_layouts(),
		)
	);

	// Site sidebar.
	$wp_customize->add_setting(
		'alcatraz_options[site_sidebar]',
		array(
			'default'    => $option_defaults['site_sidebar'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_site_sidebar_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Site Sidebar', 'alcatraz' ),
			'section'  => 'alcatraz_layout_section',
			'settings' => 'alcatraz_options[site_sidebar]',
			'choices'  => alcatraz_get_site_sidebar(),
		)
	);

	/* Header */

	// Header style.
	$wp_customize->add_setting(
		'alcatraz_options[header_style]',
		array(
			'default'    => $option_defaults['header_style'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'alcatraz_header_style_control',
		array(
			'type'     => 'radio',
			'label'    => __( 'Header Style', 'alcatraz' ),
			'section'  => 'alcatraz_header_section',
			'settings' => 'alcatraz_options[header_style]',
			'choices'  => alcatraz_get_header_styles(),
		)
	);

	/* Menu Options */

	// Mobile navigation style.
	$wp_customize->add_setting(
		'alcatraz_options[mobile_nav_style]',
		array(
			'default'    => $option_defaults['mobile_nav_style'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'transport'  => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'alcatraz_mobile_nav_style_control',
		array(
			'type'     => 'select',
			'label'    => __( 'Mobile Navigation Style', 'alcatraz' ),
			'section'  => 'alcatraz_menu_options_section',
			'settings' => 'alcatraz_options[mobile_nav_style]',
			'choices'  => alcatraz_get_mobile_nav_styles( 'mobile-nav-style' ),
		)
	);

	// Sub Page Nav.
	$wp_customize->add_setting(
		'alcatraz_options[sub_page_nav_in_sidebar]',
		array(
			'default'    => $option_defaults['sub_page_nav_in_sidebar'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'alcatraz_sub_page_nav_in_sidebar_control',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Show Page Navigation in the Sidebar on Pages?', 'alcatraz' ),
			'section'  => 'alcatraz_menu_options_section',
			'settings' => 'alcatraz_options[sub_page_nav_in_sidebar]',
		)
	);

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
			'default'    => $option_defaults['social_icons_in_footer'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
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
		ALCATRAZ_URL . 'dist/customizer-bundle.js',
		array( 'customize-preview' ),
		ALCATRAZ_VERSION,
		true
	);
}
