<?php
/**
 * Extras.
 *
 * Functionality in this file should ideally find a better final home, eventually.
 *
 * @package alcatraz
 */

add_filter( 'body_class', 'alcatraz_body_classes' );
/**
 * Add custom body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function alcatraz_body_classes( $classes ) {

	$options = get_option( 'alcatraz_options' );

	// Site sidebar class.
	if ( isset( $options['site_sidebar'] ) && 'no-sidebar' !== $options['site_sidebar'] ) {
		$classes[] = esc_attr( 'has-sidebar' );
		$classes[] = esc_attr( $options['site_sidebar'] );
	}

	// Header style class.
	if ( isset( $options['header_style'] ) && $options['header_style'] ) {
		$classes[] = 'header-style-' . esc_attr( $options['header_style'] );
	}

	// Mobile navigation style class.
	if ( isset( $options['mobile_nav_style'] ) && $options['mobile_nav_style'] ) {
		$classes[] = 'mobile-nav-style-' . esc_attr( $options['mobile_nav_style'] );
	}

	// Header image class.
	if ( get_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Custom logo class.
	if ( has_custom_logo() ) {
		$classes[] = 'has-logo';
	}

	// Footer widget areas class.
	if ( isset( $options['footer_widget_areas'] ) && 0 < (int) $options['footer_widget_areas'] ) {
		$classes[] = 'has-footer-widgets';
		$classes[] = 'footer-widget-areas-' . (int) $options['footer_widget_areas'];
	}

	return $classes;
}

/**
 * Return either an empty string or the integer value of the passed in value.
 *
 * @since 1.0.0
 *
 * @param string|int $value The value to test.
 *
 * @return string|int
 */
function alcatraz_empty_or_int( $value ) {
	if ( '' === $value ) {
		return '';
	} else {
		return intval( $value );
	}
}
