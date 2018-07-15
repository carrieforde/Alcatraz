<?php
/**
 * Alcatraz Theme Options.
 *
 * @package alcatraz
 */

/**
 * Sanitize checkbox input.
 *
 * @since 1.0.0
 *
 * @param bool $checked The value to validate.
 *
 * @return bool Whether the box is checked.
 */
function alcatraz_validate_checkbox( $checked ) {

	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
