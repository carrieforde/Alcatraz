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

	// Footer.
	if ( ! empty( $options['footer_widget_areas'] ) ) {

		// Calling register_sidebars to register only one widget area causes problems, so we'll
		// handle that case separately.
		if ( 1 === (int) $options['footer_widget_areas'] ) {
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
			register_sidebars( (int) $options['footer_widget_areas'], array(
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

add_action( 'alcatraz_footer', 'alcatraz_output_footer_widget_areas', 8 );
/**
 * Maybe output the Footer widget areas.
 *
 * @since  1.0.0
 */
function alcatraz_output_footer_widget_areas() {

	$options = get_option( 'alcatraz_options' );

	if ( isset( $options['footer_widget_areas'] ) && 0 < (int) $options['footer_widget_areas'] ) {

		echo '<section id="footer-widget-areas" class="footer-widget-areas">';

		for ( $i = 1; $i <= (int) $options['footer_widget_areas']; $i++ ) {

			$widget_area_id    = 'footer-widget-area-' . $i;
			$widget_area_class = $widget_area_id;

			// Handle inconsistent -x behavior of register_sidebars.
			if ( 1 < (int) $options['footer_widget_areas'] && 1 === $i ) {
				$widget_area_id = 'footer-widget-area';
			}

			if ( is_active_sidebar( $widget_area_id ) ) {

				printf(
					'<div id="%s" class="%s" role="complementary">',
					esc_attr( $widget_area_class ),
					esc_attr( $widget_area_class . ' footer-widget-area widget-area' )
				);

				dynamic_sidebar( $widget_area_id );

				echo '</div>';
			}
		}

		echo '</section>';
	}
}
