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
	if ( isset( $options['site_layout'] ) && $options['site_layout'] ) {
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
	if ( isset ( $options['mobile_nav_toggle_style'] ) && $options['mobile_nav_toggle_style'] ) {
		$classes[] = 'mobile-nav-toggle-style-' . esc_attr( $options['mobile_nav_toggle_style'] );
	}

	// Mobile navigation style class.
	if ( isset ( $options['mobile_nav_style'] ) && $options['mobile_nav_style'] ) {
		$classes[] = 'mobile-nav-style-' . esc_attr( $options['mobile_nav_style'] );
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

add_action( 'alcatraz_before_header_inside', 'alcatraz_output_header_image', 0 );
/**
 * Maybe output a Header image.
 *
 * @since  1.0.0
 */
function alcatraz_output_header_image() {

	if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-image-wrap" rel="home">
			<img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
		</a>
	<?php endif;
}
