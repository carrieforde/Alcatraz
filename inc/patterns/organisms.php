<?php
/**
 * Pattern Library Organisms.
 *
 * @package alcatraz
 */

/**
 * Get global element template parts.
 */
function alcatraz_get_global_element( $element ) {

	ob_start();
		get_template_part( 'template-parts/globals/global', $element );
	return ob_get_clean();
}
