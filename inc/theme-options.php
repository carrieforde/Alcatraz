<?php
/**
 * Alcatraz Theme Options.
 *
 * @package alcatraz
 */

/**
 * Return an array of the default theme options.
 *
 * @since   1.0.0
 *
 * @return  array
 */
function alcatraz_get_option_defaults() {

	$defaults = array(
		'show_activation_notice'  => 1,
		'site_sidebar'            => 'right-sidebar',
		'sub_page_nav_in_sidebar' => 0,
		'header_style'            => 'default',
		'mobile_nav_style'        => 'slide-out',
		'footer_widget_areas'     => 3,
		'footer_bottom'           => '',
		'social_icons_in_footer'  => '',
	);

	return apply_filters( 'alcatraz_option_defaults', $defaults );
}

/**
 * Validate our theme options.
 *
 * This function serves as the one and only place for all option validation.
 * Other functions that need to validate options should call this function.
 *
 * @since   1.0.0
 *
 * @param   array  $input  The options to update.
 *
 * @return  array          The updated options.
 */
function alcatraz_validate_options( $input ) {

	// Start with any existing options.
	$options = get_option( 'alcatraz_options' );

	// Update options in the Customizer.
	if ( isset( $input['site_sidebar'] ) ) {
		$options['site_sidebar'] = sanitize_text_field( $input['site_sidebar'] );
	}
	if ( isset( $input['header_style'] ) ) {
		$options['header_style'] = sanitize_text_field( $input['header_style'] );
	}
	if ( isset( $input['mobile_nav_style'] ) ) {
		$options['mobile_nav_style'] = sanitize_text_field( $input['mobile_nav_style'] );
	}
	if ( isset( $input['footer_widget_areas'] ) ) {
		$options['footer_widget_areas'] = absint( $input['footer_widget_areas'] );
	}
	if ( isset( $input['footer_bottom'] ) ) {
		$options['footer_bottom'] = wp_kses_post( $input['footer_bottom'] );
	}
	if ( isset( $input['sub_page_nav_in_sidebar'] ) ) {
		$options['sub_page_nav_in_sidebar'] = absint( $input['sub_page_nav_in_sidebar'] );
	}
	if ( isset( $input['social_icons_in_footer'] ) ) {
		$options['social_icons_in_footer'] = absint( $input['social_icons_in_footer'] );
	}

	// Update any options saved via Ajax.
	if ( isset( $input['show_activation_notice'] ) ) {
		$options['show_activation_notice'] = absint( $input['show_activation_notice'] );
	}

	return $options;
}

/**
 * Return an array of text color classes and display names.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_text_colors( $context = '' ) {

	$default_colors = array(
		'default'    => __( 'Default', 'alcatraz' ),
		'text-dark'  => __( 'Dark Text', 'alcatraz' ),
		'text-light' => __( 'Light Text', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_text_colors', $default_colors, $context );
}

/**
 * Return an array of Page Layout options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_site_sidebar( $context = '' ) {

	$styles = array(
		'no-sidebar'    => __( 'No Sidebar', 'alcatraz' ),
		'left-sidebar'  => __( 'Left Sidebar', 'alcatraz' ),
		'right-sidebar' => __( 'Right Sidebar', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_site_sidebars', $styles, $context );
}

/**
 * Return an array of Header Style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_header_styles( $context = '' ) {

	$styles = array(
		'default' => __( 'Default', 'alcatraz' ),
		'short'   => __( 'Short', 'alcatraz' ),
		'side'    => __( 'Side', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_header_styles', $styles, $context );
}

/**
 * Return an array of mobile nav style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array             The array of options.
 */
function alcatraz_get_mobile_nav_styles( $context = '' ) {

	$styles = array(
		'slide-out'   => __( 'Slide Out', 'alcatraz' ),
		'full-screen' => __( 'Full Screen', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_mobile_nav_styles', $styles, $context );
}
