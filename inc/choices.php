<?php
/**
 * Alcatraz option choices.
 *
 * @package alcatraz
 */

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
 * Return an array of mobile menu navigation style options.
 *
 * @since   1.0.0
 *
 * @return  array
 */
function alcatraz_get_mobile_nav_toggle_options( $context = '' ) {

	$mobile_nav_options = array(
		'button'    => __( 'Button', 'alcatraz' ),
		'hamburger' => __( 'Hamburger', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_mobile_nav_toggle_options', $mobile_nav_options, $context );
}
