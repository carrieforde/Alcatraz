<?php
/**
 * Pattern Library Atoms.
 *
 * @package alcatraz
 */


/**
 * Set the theme colors.
 *
 * @return  array  The theme colors.
 */
function alcatraz_set_theme_colors() {

	$colors = array(
		'alcatraz-blue' => '#0d8bb7',
		'hope' => '#fff9c0',
		'prussian-blue' => '#21759b',
	);

	return apply_filters( 'alcatraz_set_colors', $colors );
}
