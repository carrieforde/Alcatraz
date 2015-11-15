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

	global $post;

	$options = get_option( 'alcatraz_options' );

	// Page layout class.
	$page_layout = get_post_meta( $post->ID, '_alcatraz_page_layout', true );
	if ( $page_layout && 'default' != $page_layout ) {
		$classes[] = esc_attr( $page_layout );
	} elseif ( isset( $options['page_layout'] ) ) {
		$classes[] = esc_attr( $options['page_layout'] );
	}

	// Custom page classes.
	$custom_page_classes = get_post_meta( $post->ID, '_alcatraz_body_class', true );
	if ( $custom_page_classes ) {
		$classes[] = esc_attr( $custom_page_classes );
	}

	return $classes;
}
