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
function alcatraz_log( $log )  {
	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	} else {
		error_log( $log );
	}
}

/**
 * Return true or false baed on the value passed.
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
