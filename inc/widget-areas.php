<?php
/**
 * Alcatraz Widget Areas.
 *
 * @package alcatraz
 */

add_action( 'widgets_init', 'alcatraz_register_widget_areas' );
/**
 * Register the Alcatraz widget areas.
 *
 * @since  1.0.0
 */
function alcatraz_register_widget_areas() {

	$options = get_option( 'alcatraz_options' );

	// Primary Sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'alcatraz' ),
		'id'            => 'primary-sidebar',
		'description'   => __( 'Shows on the left or right side of the page or is hidden based on the "Page Layout" option', 'alcatraz' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Page Banner.
	if ( ! empty( $options['page_banner_widget_area'] ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Page Banner', 'alcatraz' ),
			'id'            => 'page-banner',
			'description'   => __( 'Shows on the top of the page in between the menu and the main content area', 'alcatraz' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	// Footer.
	if ( ! empty( $options['footer_widget_areas'] ) ) {

		// Calling register_sidebars to register only one widget area causes problems, so we'll
		// handle that case separately.
		if ( 1 == (int)$options['footer_widget_areas'] ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Footer', 'alcatraz' ),
				'id'            => 'footer-widget-area-1',
				'description'   => __( 'Shows in the footer', 'alcatraz' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		} else {
			register_sidebars( (int)$options['footer_widget_areas'], array(
				'name'          => esc_html__( 'Footer %d', 'alcatraz' ),
				'id'            => 'footer-widget-area',
				'description'   => __( 'Shows in the footer', 'alcatraz' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
	}
}

add_action( 'alcatraz_primary_sidebar', 'alcatraz_output_primary_sidebar' );
/**
 * Maybe output the Primary Sidebar widget area.
 *
 * @since  1.0.0
 */
function alcatraz_output_primary_sidebar() {

	global $post;

	$options = get_option( 'alcatraz_options' );

	$page_layout = get_post_meta( $post->ID, '_alcatraz_page_layout', true );

	// Bail if the page layout is set to full-width.
	if ( $page_layout ) {
		if ( 'no-sidebar' === $page_layout ) {
			return;
		} elseif ( 'default' === $page_layout && isset( $options['page_layout'] ) && 'no-sidebar' === $options['page_layout'] ) {
			return;
		}
	} else {
		if ( isset( $options['page_layout'] ) && 'no-sidebar' === $options['page_layout'] ) {
			return;
		}
	}

	?>
	<div id="secondary" class="primary-sidebar sidebar" role="complementary">
		<?php do_action( 'alcatraz_before_primary_sidebar' ); ?>
		<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
			<div class="primary-sidebar-widget-area widget-area">
				<?php dynamic_sidebar( 'primary-sidebar' ); ?>
			</div>
		<?php endif; ?>
		<?php do_action( 'alcatraz_after_primary_sidebar' ); ?>
	</div>
	 <?php
}

add_action( 'alcatraz_before_content_inside', 'alcatraz_output_page_banner_widget_area' );
/**
 * Maybe output the Page Banner widget area.
 *
 * @since  1.0.0
 */
function alcatraz_output_page_banner_widget_area() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['page_banner_widget_area'] ) && is_active_sidebar( 'page-banner' ) ) {
		?>
		<section id="page-banner" class="page-banner page-banner-widget-area widget-area" role="complementary">
			<?php dynamic_sidebar( 'page-banner' ); ?>
		</section>
		<?php
	}
}

add_action( 'alcatraz_footer', 'alcatraz_output_footer_widget_areas', 8 );
/**
 * Maybe output the Footer widget areas.
 *
 * @since  1.0.0
 */
function alcatraz_output_footer_widget_areas() {

	$options = get_option( 'alcatraz_options' );

	if ( isset( $options['footer_widget_areas'] ) && 0 < (int)$options['footer_widget_areas'] ) {

		echo '<section id="footer-widget-areas" class="footer-widget-areas">';

		for ( $i = 1; $i <= (int)$options['footer_widget_areas']; $i++ ) {

			$widget_area_id    = 'footer-widget-area-' . $i;
			$widget_area_class = $widget_area_id;

			// Handle inconsistent -x behavior of register_sidebars.
			if ( 1 < (int)$options['footer_widget_areas'] && 1 === $i ) {
				$widget_area_id = 'footer-widget-area';
			}

			if ( is_active_sidebar( $widget_area_id ) ) {

				printf(
					'<div id="%s" class="%s" role="complementary">',
					$widget_area_class,
					$widget_area_class . ' footer-widget-area widget-area'
				);

				dynamic_sidebar( $widget_area_id );

				echo '</div>';
			}
		}

		echo '</section>';
	}
}
