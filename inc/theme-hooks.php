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

	<?php
	endif;
}

add_action( 'alcatraz_header', 'alcatraz_output_site_title', 10 );
/**
 * Output the site title.
 *
 * @since  1.0.0
 */
function alcatraz_output_site_title() {

	$classes = 'site-title';

	if ( has_custom_logo() ) {
		$classes .= ' screen-reader-text';
	}

	if ( is_front_page() && is_home() ) {
		printf(
			'<h1 class="%s"><a href="%s" rel="home">%s</a></h1>',
			esc_attr( $classes ),
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	} else {
		printf(
			'<p class="%s"><a href="%s" rel="home">%s</a></p>',
			esc_attr( $classes ),
			esc_url( home_url( '/' ) ),
			esc_html( get_bloginfo( 'name' ) )
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

	$classes = 'site-description';
	$options = get_option( 'alcatraz_options' );

	if ( isset( $options['hide_tagline'] ) && $options['hide_tagline'] ) {
		$classes .= ' screen-reader-text';
	}

	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		printf(
			'<p class="%s">%s</p>',
			esc_attr( $classes ),
			esc_html( $description )
		);
	}
}

add_action( 'alcatraz_header', 'alcatraz_output_logo', 5 );
/**
 * Output the site logo.
 *
 * @since 1.0.1
 */
function alcatraz_output_logo() {

	if ( ! has_custom_logo() ) {
		return;
	}

	the_custom_logo();
}

add_action( 'alcatraz_entry_header_inside', 'alcatraz_output_default_entry_header' );
/**
 * Output the default entry header inner content.
 *
 * @since  1.0.0
 *
 * @param int $post_id The current post ID.
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
 * @since 1.0.0
 *
 * @param int $post_id The current post ID.
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

add_action( 'alcatraz_footer', 'alcatraz_output_footer_credits', 30 );
/**
 * Output the footer bottom.
 *
 * @since  1.0.0
 */
function alcatraz_output_footer_credits() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['footer_credits'] ) ) {
		printf(
			'<div class="footer-credits">%s</div>',
			wp_kses_post( do_shortcode( $options['footer_credits'] ) )
		);
	}
}

add_action( 'alcatraz_footer', 'alcatraz_social_menu_in_footer', 80 );
/**
 * Output the social nav menu.
 *
 * @author Carrie Forde
 * @since  1.0.0
 */
function alcatraz_social_menu_in_footer() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['social_icons_in_footer'] ) && has_nav_menu( 'social' ) ) {

	?>

		<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'alcatraz' ); ?>">

			<?php
			wp_nav_menu( array(
				'theme_location' => 'social',
				'menu_class'     => 'menu social-links-menu',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
			) );
			?>
		</nav>

	<?php
	}
}

add_filter( 'style_loader_src', 'alcatraz_remove_core_version_numbers', 9999 );
add_filter( 'script_loader_src', 'alcatraz_remove_core_version_numbers', 9999 );
/**
 * Remove version numbers from WP Core styles & scripts.
 *
 * @since 1.0.0
 *
 * @param string $src The file src being loaded.
 * @return string The new src without a version number.
 * @link https://www.coreymcollins.com/2018/02/13/i-boosted-the-crap-out-of-my-site-speed-in-a-weekend/
 */
function alcatraz_remove_core_version_numbers( $src ) {

	$src = remove_query_arg( 'ver', $src );
	return $src;
}

add_action( 'wp_default_scripts', 'alcatraz_wp_default_scripts' );
/**
 * Load jQuery & associated scripts in the footer.
 *
 * @since 1.0.0
 *
 * @param array $scripts Files to be moved.
 * @link https://www.coreymcollins.com/2018/02/13/i-boosted-the-crap-out-of-my-site-speed-in-a-weekend/
 */
function alcatraz_wp_default_scripts( $scripts ) {

	// Bail if we're in the admin.
	if ( is_admin() ) {
		return;
	}

	$scripts->add_data( 'jquery', 'group', 1 );
	$scripts->add_data( 'jquery-core', 'group', 1 );
	$scripts->add_data( 'jquery-migrate', 'group', 1 );
}
