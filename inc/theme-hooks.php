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

	if ( get_header_image() ) : ?>
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

		ob_start(); ?>

		<div class="alcatraz-social-icon-wrap">
			<ul class="alcatraz-social-icons">
				<?php if ( isset( $options['email_url'] ) ) : ?>
					<li class="email">
						<a href="mailto:<?php echo esc_attr( $options['email_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-email" target="_blank">
							<i class="fa fa-envelope"></i>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( isset( $options['facebook_url'] ) ) : ?>
					<li class="facebook">
						<a href="<?php echo esc_url( $options['facebook_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-facebook" target="_blank">
							<i class="fa fa-facebook"></i>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( isset( $options['twitter_url'] ) ) : ?>
					<li class="twitter">
						<a href="<?php echo esc_url( $options['twitter_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-twitter" target="_blank">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( isset( $options['instagram_url'] ) ) : ?>
					<li class="instagram">
						<a href="<?php echo esc_url( $options['instagram_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-instagram" target="_blank">
							<i class="fa fa-instagram"></i>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( isset( $options['pinterest_url'] ) ) : ?>
					<li class="pinterest">
						<a href="<?php echo esc_url( $options['pinterest_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-pinterest" target="_blank">
							<i class="fa fa-pinterest"></i>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( isset( $options['youtube_url'] ) ) : ?>
					<li class="youtube">
						<a href="<?php echo esc_url( $options['youtube_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-youtube" target="_blank">
							<i class="fa fa-youtube"></i>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php

	echo ob_get_clean();
	}
}
