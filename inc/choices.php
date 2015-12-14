<?php
/**
 * Alcatraz option choices.
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
	);

	return apply_filters( 'alcatraz_option_defaults', $defaults );
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
