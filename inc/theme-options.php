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
		'show_activation_notice'  => 1,
		'footer_widget_areas'     => 3,
		'footer_bottom'           => '',
		'social_icons_in_footer'  => '',
	);

	return apply_filters( 'alcatraz_option_defaults', $defaults );
}

/**
 * Validate our theme options.
 *
 * This function serves as the one and only place for all option validation.
 * Other functions that need to validate options should call this function.
 *
 * @since   1.0.0
 *
 * @param   array  $input  The options to update.
 *
 * @return  array          The updated options.
 */
function alcatraz_validate_options( $input ) {

	// Start with any existing options.
	$options = get_option( 'alcatraz_options' );

	// Update options in the Customizer.
	if ( isset( $input['footer_widget_areas'] ) ) {
		$options['footer_widget_areas'] = absint( $input['footer_widget_areas'] );
	}
	if ( isset( $input['footer_bottom'] ) ) {
		$options['footer_bottom'] = wp_kses_post( $input['footer_bottom'] );
	}
	if ( isset( $input['social_icons_in_footer'] ) ) {
		$options['social_icons_in_footer'] = absint( $input['social_icons_in_footer'] );
	}

	// Update any options saved via Ajax.
	if ( isset( $input['show_activation_notice'] ) ) {
		$options['show_activation_notice'] = absint( $input['show_activation_notice'] );
	}

	return $options;
}
