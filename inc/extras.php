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

	// If primary sidebar is active, and we're not on a patterns page, add the 'has-sidebar' class.
	if ( is_active_sidebar( 'primary-sidebar' ) && ! ( is_page_template( 'template-patterns-atoms.php' ) || is_page_template( 'template-patterns-molecules.php' ) || is_page_template( 'template-patterns-organisms.php' ) ) ) {
		$classes[] = 'has-sidebar';
	}

	// Footer widget areas class.
	if ( isset( $options['footer_widget_areas'] ) && 0 < (int) $options['footer_widget_areas'] ) {
		$classes[] = 'footer-widget-areas-' . (int) $options['footer_widget_areas'];
	}

	return $classes;
}
