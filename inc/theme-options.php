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
		'site_layout'             => 'full-width',
		'page_layout'             => 'right-sidebar',
		'page_banner_widget_area' => 0,
		'sub_page_nav_in_sidebar' => 0,
		'header_style'            => 'default',
		'mobile_nav_toggle_style' => 'hamburger',
		'mobile_nav_style'        => 'default',
		'sub_menu_toggle_style'   => 'chevron',
		'logo_id'                 => '',
		'mobile_logo_id'          => '',
		'footer_widget_areas'     => 3,
		'footer_bottom'           => '',
		'social_icons_in_footer'  => '',
	);

	$networks = alcatraz_get_social_networks();

	 // Loop over any social networks and default the network URLs to empty string.
	 foreach ( $networks as $network => $network_data ) {
		 $defaults[ $network . '_url' ] = '';
	 }

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

	$networks = alcatraz_get_social_networks();

	// Update options on the options page.
	foreach ( $networks as $network => $network_data ) {
		if ( isset( $input[ $network . '_url' ] ) ) {
			$options[ $network . '_url' ] = sanitize_text_field( $input[ $network . '_url' ] );
		}
	}

	// Update options in the Customizer.
	if ( isset( $input['site_layout'] ) ) {
		$options['site_layout'] = sanitize_text_field( $input['site_layout'] );
	}
	if ( isset( $input['page_layout'] ) ) {
		$options['page_layout'] = sanitize_text_field( $input['page_layout'] );
	}
	if ( isset( $input['page_banner_widget_area'] ) ) {
		$options['page_banner_widget_area'] = absint( $input['page_banner_widget_area'] );
	}
	if ( isset( $input['header_style'] ) ) {
		$options['header_style'] = sanitize_text_field( $input['header_style'] );
	}
	if ( isset( $input['mobile_nav_toggle_style'] ) ) {
		$options['mobile_nav_toggle_style'] = sanitize_text_field( $input['mobile_nav_toggle_style'] );
	}
	if ( isset( $input['mobile_nav_style'] ) ) {
		$options['mobile_nav_style'] = sanitize_text_field( $input['mobile_nav_style'] );
	}
	if ( isset( $input['sub_menu_toggle_style'] ) ) {
		$options['sub_menu_toggle_style'] = sanitize_text_field( $input['sub_menu_toggle_style'] );
	}
	if ( isset( $input['logo_id'] ) ) {
		$options['logo_id'] = alcatraz_empty_or_int( $input['logo_id'] );
	}
	if ( isset( $input['mobile_logo_id'] ) ) {
		$options['mobile_logo_id'] = alcatraz_empty_or_int( $input['mobile_logo_id'] );
	}
	if ( isset( $input['footer_widget_areas'] ) ) {
		$options['footer_widget_areas'] = absint( $input['footer_widget_areas'] );
	}
	if ( isset( $input['footer_bottom'] ) ) {
		$options['footer_bottom'] = wp_kses_post( $input['footer_bottom'] );
	}
	if ( isset( $input['sub_page_nav_in_sidebar'] ) ) {
		$options['sub_page_nav_in_sidebar'] = absint( $input['sub_page_nav_in_sidebar'] );
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

/**
 * Return an array of text color classes and display names.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_text_colors( $context = '' ) {

	$default_colors = array(
		'default'    => __( 'Default', 'alcatraz' ),
		'text-dark'  => __( 'Dark Text', 'alcatraz' ),
		'text-light' => __( 'Light Text', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_text_colors', $default_colors, $context );
}

/**
 * Return an array of Site Layout options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_site_layouts( $context = '' ) {

	$styles = array(
		'full-width'    => __( 'Full Width', 'alcatraz' ),
		'boxed'         => __( 'Boxed', 'alcatraz' ),
		'boxed-content' => __( 'Boxed Content', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_site_layouts', $styles, $context );
}

/**
 * Return an array of Page Layout options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_site_sidebar( $context = '' ) {

	$styles = array(
		'no-sidebar'    => __( 'No Sidebar', 'alcatraz' ),
		'left-sidebar'  => __( 'Left Sidebar', 'alcatraz' ),
		'right-sidebar' => __( 'Right Sidebar', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_site_sidebars', $styles, $context );
}

/**
 * Return an array of Header Style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array
 */
function alcatraz_get_header_styles( $context = '' ) {

	$styles = array(
		'default' => __( 'Default', 'alcatraz' ),
		'short'   => __( 'Short', 'alcatraz' ),
		'side'    => __( 'Side', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_header_styles', $styles, $context );
}

/**
 * Return an array of mobile nav style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array             The array of options.
 */
function alcatraz_get_mobile_nav_styles( $context = '' ) {

	$styles = array(
		'default'     => __( 'Default', 'alcatraz' ),
		'slide-left'  => __( 'Slide from Left', 'alcatraz' ),
		'slide-right' => __( 'Slide from Right', 'alcatraz' ),
		'full-screen' => __( 'Full Screen', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_mobile_nav_styles', $styles, $context );
}

/**
 * Return an array of mobile nav toggle style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array             The array of options.
 */
function alcatraz_get_mobile_nav_toggles( $context = '' ) {

	$toggles = array(
		'button'    => __( 'Button', 'alcatraz' ),
		'hamburger' => __( 'Hamburger', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_mobile_nav_toggles', $toggles, $context );
}

/**
 * Return an array of sub-menu toggle style options.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to our filter.
 *
 * @return  array             The array of options.
 */
function alcatraz_get_sub_menu_toggles( $context = '' ) {

	$toggles = array(
		'chevron'    => __( 'Chevron', 'alcatraz' ),
		'plus-minus' => __( 'Plus-Minus', 'alcatraz' ),
	);

	return apply_filters( 'alcatraz_sub_menu_toggle_styles', $toggles, $context );
}

/**
 * Return an array of the social network data.
 *
 * @since   1.0.0
 *
 * @param   string  $context  The context to pass to the filter.
 *
 * @return  array
 */
function alcatraz_get_social_networks( $context = '' ) {

	$networks = array(
		'email' => array(
			'display_name' => __( 'Email', 'alcatraz' ),
			'description'  => __( 'Enter your email address', 'alcatraz' ),
			'icon'         => 'envelope',
		),
		'facebook' => array(
			'display_name' => __( 'Facebook', 'alcatraz' ),
			'description'  => __( 'Enter your Facebook url', 'alcatraz' ),
			'icon'         => 'facebook',
		),
		'twitter' => array(
			'display_name' => __( 'Twitter', 'alcatraz' ),
			'description'  => __( 'Enter your Twitter url', 'alcatraz' ),
			'icon'         => 'twitter',
		),
		'instagram' => array(
			'display_name' => __( 'Instagram', 'alcatraz' ),
			'description'  => __( 'Enter your Instagram url', 'alcatraz' ),
			'icon'         => 'instagram',
		),
		'pinterest' => array(
			'display_name' => __( 'Pinterest', 'alcatraz' ),
			'description'  => __( 'Enter your Pinterest url', 'alcatraz' ),
			'icon'         => 'twitter',
		),
		'youtube' => array(
			'display_name' => __( 'Youtube', 'alcatraz' ),
			'description'  => __( 'Enter your Youtube url', 'alcatraz' ),
			'icon'         => 'youtube',
		),
	);

	return apply_filters( 'alcatraz_social_networks', $networks, $context );
}
