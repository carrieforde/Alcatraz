<?php
/**
 * Alcatraz Theme Options.
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
		'show_activation_notice' => 1
	);

	return apply_filters( 'alcatraz_option_defaults', $defaults );
}

/**
 * Return an array of the default theme mods.
 *
 * @since 1.0.0
 *
 * @return array
 */
function alcatraz_get_theme_mod_defaults() {

	$defaults = array(
		'hide_tagline'           => false,
		'footer_widget_areas'    => 3,
		'footer_credits'         => '',
		'social_icons_in_footer' => false,
	);

	return apply_filters( 'alcatraz_theme_mod_defaults', $defaults );
}
