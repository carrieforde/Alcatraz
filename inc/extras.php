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

	$footer_widgets = get_theme_mod( 'footer_widget_areas', 3 );

	// Header image class.
	if ( get_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Custom logo class.
	if ( has_custom_logo() ) {
		$classes[] = 'has-logo';
	}

	// Footer widget areas class.
	if ( 0 < (int) $footer_widgets ) {
		$classes[] = 'has-footer-widgets';
		$classes[] = 'footer-widget-areas-' . (int) $footer_widgets;
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
