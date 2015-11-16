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

	return apply_filters( 'alcatraz_text_colors', $default_colors );
}