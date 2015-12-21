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
		'site_layout'             => 'full-width',
		'page_layout'             => 'right-sidebar',
		'page_banner_widget_area' => 0,
		'header_style'            => 'default',
		'mobile_nav_toggle_style' => 'hamburger',
		'mobile_nav_style'        => 'default',
		'sub_menu_toggle_style'   => 'chevron',
		'logo_id'                 => '',
		'mobile_logo_id'          => '',
		'footer_widget_areas'     => 3,
		'footer_bottom'           => '',
		'facebook_url'            => '',
		'twitter_url'             => '',
		'instagram_url'           => '',
		'pinterest_url'           => '',
		'youtube_url'             => '',
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

	// Update options on the options page.
	if ( isset( $input['facebook_url'] ) ) {
		$options['facebook_url']  = sanitize_text_field( $input['facebook_url'] );
	}
	if ( isset( $input['twitter_url'] ) ) {
		$options['twitter_url']   = sanitize_text_field( $input['twitter_url'] );
	}
	if ( isset( $input['instagram_url'] ) ) {
		$options['instagram_url'] = sanitize_text_field( $input['instagram_url'] );
	}
	if ( isset( $input['pinterest_url'] ) ) {
		$options['pinterest_url'] = sanitize_text_field( $input['pinterest_url'] );
	}
	if ( isset( $input['youtube_url'] ) ) {
		$options['youtube_url']   = sanitize_text_field( $input['youtube_url'] );
	}

	// Update options in the Customizer.
	if ( isset( $input['site_layout'] ) ) {
		$options['site_layout'] = sanitize_text_field( $input['site_layout'] );
	}
	if ( isset( $input['page_layout'] ) ) {
		$options['page_layout'] = sanitize_text_field( $input['page_layout'] );
	}
	if ( isset( $input['page_banner_widget_area'] ) ) {
		$options['page_banner_widget_area'] = absint( $input['page_banner_widget_area'] );
	}
	if ( isset( $input['header_style'] ) ) {
		$options['header_style'] = sanitize_text_field( $input['header_style'] );
	}
	if ( isset( $input['mobile_nav_toggle_style'] ) ) {
		$options['mobile_nav_toggle_style'] = sanitize_text_field( $input['mobile_nav_toggle_style'] );
	}
	if ( isset( $input['mobile_nav_style'] ) ) {
		$options['mobile_nav_style'] = sanitize_text_field( $input['mobile_nav_style'] );
	}
	if ( isset( $input['sub_menu_toggle_style'] ) ) {
		$options['sub_menu_toggle_style'] = sanitize_text_field( $input['sub_menu_toggle_style'] );
	}
	if ( isset( $input['logo_id'] ) ) {
		$options['logo_id'] = alcatraz_empty_or_int( $input['logo_id'] );
	}
	if ( isset( $input['mobile_logo_id'] ) ) {
		$options['mobile_logo_id'] = alcatraz_empty_or_int( $input['mobile_logo_id'] );
	}
	if ( isset( $input['footer_widget_areas'] ) ) {
		$options['footer_widget_areas'] = absint( $input['footer_widget_areas'] );
	}
	if ( isset( $input['footer_bottom'] ) ) {
		$options['footer_bottom'] = sanitize_text_field( $input['footer_bottom'] );
	}

	// Update any options saved via Ajax.
	if ( isset( $input['show_activation_notice'] ) ) {
		$options['show_activation_notice'] = $input['show_activation_notice'];
	}

	return $options;
}

/**
 * Return an array of text color classes and display names.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context the colors will be used in.
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
 * Return an array of mobile nav toggle style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array             The array of options.
 */
function alcatraz_get_mobile_nav_toggle_options( $context = '' ) {

	$mobile_nav_toggle_styles = array(
		'button'    => __( 'Button', 'alcatraz' ),
		'hamburger' => __( 'Hamburger', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_mobile_nav_toggle_options', $mobile_nav_toggle_styles, $context );
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
function alcatraz_get_mobile_nav_style_options( $context = '' ) {

	$mobile_nav_styles = array(
		'default'     => __( 'Default', 'alcatraz' ),
		'slide-left'  => __( 'Slide from Left', 'alcatraz' ),
		'slide-right' => __( 'Slide from Right', 'alcatraz' ),
		'full-screen' => __( 'Full Screen', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_mobile_nav_style_options', $mobile_nav_styles, $context );
}

/**
 * Return an array of sub-menu toggle style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array             The array of options.
 */
function alcatraz_get_sub_menu_toggle_styles( $context = '' ) {

	$sub_menu_toggle_styles = array(
		'chevron'    => __( 'Chevron', 'alcatraz' ),
		'plus-minus' => __( 'Plus-Minus', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_sub_menu_toggle_styles', $sub_menu_toggle_styles, $context );
}
