<?php
/**
 * Alcatraz Theme Hooks.
 *
 * This file contains any output that is included on the alcatraz_* hooks.
 *
 * @package alcatraz
 */

add_action( 'alcatraz_header', 'alcatraz_output_site_title', 5 );
/**
 * Output the site title.
 *
 * @since  1.0.0
 */
function alcatraz_output_site_title() {

	if ( is_front_page() && is_home() ) {
		printf(
			'<h1 class="site-title"><a href="%s" rel="home">%s</a></h1>',
			esc_url( home_url( '/' ) ),
			get_bloginfo( 'name' )
		);
	} else {
		printf(
			'<p class="site-title"><a href="%s" rel="home">%s</a></p>',
			esc_url( home_url( '/' ) ),
			get_bloginfo( 'name' )
		);
	}
}

add_action( 'alcatraz_header', 'alcatraz_output_site_description', 15 );
/**
 * Output the site description.
 *
 * @since  1.0.0
 */
function alcatraz_output_site_description() {

	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		printf(
			'<p class="%s">%s</p>',
			'site-description',
			$description
		);
	}
}

add_action( 'alcatraz_header', 'alcatraz_output_logo', 2 );
/**
 * Output the site logo.
 *
 * @since  1.0.0
 */
function alcatraz_output_logo() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['logo_id'] ) || ! empty( $options['mobile_logo_id'] ) ) {

    	echo '<div class="logo-wrap">';

        printf(
            '<a href="%s" title="%s" rel="home">',
            esc_url( home_url( '/' ) ),
            esc_attr( get_bloginfo( 'name', 'display' ) )
        );

        if ( ! empty( $options['logo_id'] ) ) {

            printf(
                '<img class="logo logo-regular" src="%s" alt="%s">',
                esc_url( wp_get_attachment_image_src( $options['logo_id'], 'full' )[0] ),
                esc_attr( get_bloginfo( 'name', 'display' ) )
            );

        }

        if ( ! empty( $options['mobile_logo_id'] ) ) {
            printf(
                '<img class="logo logo-mobile" src="%s" alt="%s">',
                esc_url( wp_get_attachment_image_src( $options['mobile_logo_id'], 'full' )[0] ),
                esc_attr( get_bloginfo( 'name', 'display' ) )
            );
        }

        echo '</a>';

        echo '</div>';
    }
}

add_action( 'alcatraz_footer', 'alcatraz_output_footer_bottom', 30 );
/**
 * Output the footer bottom.
 *
 * @since  1.0.0
 */
function alcatraz_output_footer_bottom() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['footer_bottom'] ) ) {
		printf(
			'<div class="footer-bottom">%s</div>',
			wp_kses_post( do_shortcode( $options['footer_bottom'] ) )
		);
	}
}
