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

	// Site layout class.
	$page_width = get_post_meta( $post->ID, '_alcatraz_page_width', true );
	if ( $page_width && 'default' != $page_width ) {
		$classes[] = esc_attr( $page_width );
	} elseif ( isset( $options['site_layout'] ) && $options['site_layout'] ) {
		$classes[] = esc_attr( $options['site_layout'] );
	}

	// Page layout class.
	$page_layout = get_post_meta( $post->ID, '_alcatraz_page_layout', true );
	if ( $page_layout && 'default' != $page_layout ) {
		if ( 'no-sidebar' != $page_layout ) {
			$classes[] = esc_attr( $page_layout );
		}
	} elseif ( isset( $options['page_layout'] ) && 'no-sidebar' != $options['page_layout'] ) {
		$classes[] = esc_attr( $options['page_layout'] );
	}

	// Header style class.
	if ( isset( $options['header_style'] ) && $options['header_style'] ) {
		$classes[] = 'header-style-' . esc_attr( $options['header_style'] );
	}

	// Mobile navigation toggle style class.
	if ( isset( $options['mobile_nav_toggle_style'] ) && $options['mobile_nav_toggle_style'] ) {
		$classes[] = 'mobile-nav-toggle-style-' . esc_attr( $options['mobile_nav_toggle_style'] );
	}

	// Mobile navigation style class.
	if ( isset( $options['mobile_nav_style'] ) && $options['mobile_nav_style'] ) {
		$classes[] = 'mobile-nav-style-' . esc_attr( $options['mobile_nav_style'] );
	}

	// Sub-menu toggle style class.
	if ( isset( $options['sub_menu_toggle_style'] ) && $options['sub_menu_toggle_style'] ) {
		$classes[] = 'sub-menu-toggle-style-' . esc_attr( $options['sub_menu_toggle_style'] );
	}

	// Transparent header class.
	$transparent_header = get_post_meta( $post->ID, '_alcatraz_transparent_header', true );
	if ( $transparent_header && 'on' == $transparent_header ) {
		$classes[] = 'transparent-header';
	}

	// Header image class.
	if ( get_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Logo class
	if ( ! empty( $options['logo_id'] ) ) {
		$classes[] = 'has-logo';
	}

	// Mobile logo class
	if ( ! empty( $options['mobile_logo_id'] ) ) {
		$classes[] = 'has-mobile-logo';
	}

	// Header text color class.
	$header_text_color = get_post_meta( $post->ID, '_alcatraz_header_text_color', true );
	if ( $header_text_color && 'default' != $header_text_color ) {
		$classes[] = 'header-' . esc_attr( $header_text_color );
	}

	// Page Banner class.
	if ( isset( $options['page_banner_widget_area'] ) && $options['page_banner_widget_area'] && is_active_sidebar( 'page-banner' ) ) {
		$classes[] = 'has-page-banner';
	}

	// Footer widget areas class.
	if ( isset( $options['footer_widget_areas'] ) && 0 < (int)$options['footer_widget_areas'] ) {
		$classes[] = 'footer-widget-areas-' . (int)$options['footer_widget_areas'];
	}

	// Custom page classes.
	$custom_page_classes = get_post_meta( $post->ID, '_alcatraz_body_class', true );
	if ( $custom_page_classes ) {
		$classes[] = esc_attr( $custom_page_classes );
	}

	return $classes;
}

/**
 * Return either an empty string or the integer value of the passed in value.
 *
 * @since   1.0.0
 *
 * @param   string|int  $value  The value to test.
 *
 * @return  string|int
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
 */
function alcatraz_allowed_post_types( $context = '' ) {

	$post_type = array(
		'page',
	);

	return apply_filters( 'alcatraz_post_types', $post_type, $context );
}
