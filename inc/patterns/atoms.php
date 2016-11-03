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
		'hope'          => '#fff9c0',
		'jelly-bean'    => '#21759b',
	);

	return apply_filters( 'alcatraz_set_colors', $colors );
}

/**
 * Set the theme fonts.
 *
 * @return  array  The theme fonts.
 */
function alcatraz_set_theme_fonts() {

	$fonts = array(
		'primary' => '\'Source Sans Pro\', sans-serif',
		'code'    => '\'Source Code Pro\', Courier, monospace',
	);

	return apply_filters( 'alcatraz_set_fonts', $fonts );
}
