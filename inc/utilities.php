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