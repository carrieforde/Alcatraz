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
 * @since   1.0.0
 *
 * @param   array  $classes  Classes for the body element.
 * @return  array
 */
function alcatraz_body_classes( $classes ) {

	// Footer widget areas class.
	if ( isset( $options['footer_widget_areas'] ) && 0 < (int) $options['footer_widget_areas'] ) {
		$classes[] = 'footer-widget-areas-' . (int) $options['footer_widget_areas'];
	}

	return $classes;
}
