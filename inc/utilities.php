<?php
/**
 * Alcatraz utility functions.
 *
 * @package alcatraz
 */

/**
 * Custom logging function.
 *
 * This will handle strings, arrays, and objects, and it
 * doesn't require WP_DEBUG to be set to true.
 *
 * @since  1.0.0
 */
function alcatraz_log( $log ) {
	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	} else {
		error_log( $log );
	}
}

/**
 * Return true or false based on the value passed.
 *
 * @since 1.0.0
 *
 * @param   mixed  $value The value to be tested.
 * @return  bool
 */
function alcatraz_true_or_false( $value ) {

	if ( ! isset( $value ) ) {
		return false;
	}

	if ( true === $value || 'true' === $value || 1 === $value || 'yes' === $value || 'on' === $value ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Return either an empty string or the integer value of the passed in value.
 *
 * @since   1.0.0
 *
 * @param   string|int  $value  The value to test.
 *
 * @return  string|int
 */
function alcatraz_empty_or_int( $value ) {
	if ( '' === $value ) {
		return '';
	} else {
		return intval( $value );
	}
}

/**
 * A utility function for getting image dimensions.
 *
 * @return array The image sizes and dimensions.
 */
function alcatraz_get_image_sizes() {

	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}
