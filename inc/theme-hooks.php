<?php
/**
 * Alcatraz Theme Hooks.
 *
 * This file contains any output that is included on the alcatraz_* hooks.
 *
 * @package alcatraz
 */

add_action( 'alcatraz_before_header_inside', 'alcatraz_output_header_image', 0 );
/**
 * Maybe output a Header image.
 *
 * @since  1.0.0
 */
function alcatraz_output_header_image() {

	if ( apply_filters( 'alcatraz_enable_custom_header', false ) && get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-image-wrap" rel="home">
			<img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
		</a>
	<?php endif;
}

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

add_action( 'alcatraz_before_primary_sidebar', 'alcatraz_output_sub_page_nav' );
/**
 * Output the Sub Page Navigation.
 *
 * @since  1.0.0
 */
function alcatraz_output_sub_page_nav() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['sub_page_nav_in_sidebar'] ) ) {
		alcatraz_the_sub_page_nav();
	}
}

add_action( 'alcatraz_entry_header_inside', 'alcatraz_output_default_entry_header' );
/**
 * Output the default entry header inner content.
 *
 * @since  1.0.0
 *
 * @param  int  $post_id  The current post ID.
 */
function alcatraz_output_default_entry_header( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	alcatraz_the_entry_title( $post_id );
	alcatraz_the_entry_meta( $post_id );
}

add_action( 'alcatraz_entry_footer_inside', 'alcatraz_output_default_entry_footer' );
/**
 * Output the default entry footer inner content.
 *
 * @since  1.0.0
 *
 * @param  int  $post_id  The current post ID.
 */
function alcatraz_output_default_entry_footer( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	alcatraz_the_edit_post_link( $post_id );

	$footer_taxonomies = array(
		'category' => __( 'Posted in: ', 'alcatraz' ),
		'post_tag' => __( 'Tagged: ', 'alcatraz' ),
	);
	$footer_taxonomies = apply_filters( 'alcatraz_entry_footer_taxonomies', $footer_taxonomies, $post_id );

	foreach ( $footer_taxonomies as $footer_taxonomy => $label ) {
		alcatraz_the_taxonomy_term_list( $post_id, $footer_taxonomy, $label, ', ' );
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

add_action( 'alcatraz_footer', 'alcatraz_output_social_network_icons', 80 );
/**
 * Output the social network icons.
 *
 * @since 1.0.0
 */
function alcatraz_output_social_network_icons() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['social_icons_in_footer'] ) ) {

		alcatraz_the_social_network_icons();
	}
}
