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

	if ( is_home() ) {
		$post_id = get_option( 'page_for_posts' );
	} else {
		$post_id = get_the_ID();
	}

	// Site sidebar class.
	$page_sidebar = get_post_meta( $post_id, '_alcatraz_page_sidebar', true );
	if ( $page_sidebar && 'default' !== $page_sidebar ) {
		if ( 'no-sidebar' !== $page_sidebar ) {
			$classes[] = esc_attr( $page_sidebar );
		}
	} elseif ( isset( $options['site_sidebar'] ) && 'no-sidebar' !== $options['site_sidebar'] ) {
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

	// Transparent header class.
	$transparent_header = get_post_meta( $post_id, '_alcatraz_transparent_header', true );
	if ( $transparent_header && 'on' === $transparent_header ) {
		$classes[] = 'transparent-header';
	}

	// Header image class.
	if ( get_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Header text color class.
	$header_text_color = get_post_meta( $post_id, '_alcatraz_header_text_color', true );
	if ( $header_text_color && 'default' !== $header_text_color ) {
		$classes[] = 'header-' . esc_attr( $header_text_color );
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

	// Custom page classes.
	$custom_page_classes = get_post_meta( $post_id, '_alcatraz_body_class', true );
	if ( $custom_page_classes ) {
		$classes[] = esc_attr( $custom_page_classes );
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

/**
 * Filter post types passed to our Custom Meta box.
 *
 * @param array $context The post types on which the CMB2 metaboxes display.
 */
function alcatraz_allowed_post_types( $context = array() ) {

	$post_type = array(
		'page',
	);

	return apply_filters( 'alcatraz_post_types', $post_type, $context );
}
