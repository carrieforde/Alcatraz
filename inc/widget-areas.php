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

	$footer_widgets = get_theme_mod( 'footer_widget_areas', 3 );

	// Primary Sidebar.
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 1', 'alcatraz' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Shows on the left or right side of the page or is hidden based on the "Page Layout" option', 'alcatraz' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Footer.
	if ( 0 < $footer_widgets ) {

		// Calling register_sidebars to register only one widget area causes problems, so we'll
		// handle that case separately.
		if ( 1 === (int) $footer_widgets ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Footer', 'alcatraz' ),
				'id'            => 'footer-widget-area-1',
				'description'   => __( 'Shows in the footer', 'alcatraz' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		} else {
			register_sidebars( (int) $footer_widgets, array(
				/* translators: %d: the widget number. */
				'name'          => esc_html__( 'Footer %d', 'alcatraz' ),
				'id'            => 'footer-widget-area',
				'description'   => __( 'Shows in the footer', 'alcatraz' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}
	}
}

add_action( 'alcatraz_sidebar', 'alcatraz_output_primary_sidebar' );
/**
 * Maybe output the Primary Sidebar widget area.
 *
 * @since  1.0.0
 */
function alcatraz_output_primary_sidebar() {

	?>

	<aside id="secondary" class="sidebar widget-area">
		<?php do_action( 'alcatraz_before_sidebar' ); ?>
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php endif; ?>
		<?php do_action( 'alcatraz_after_sidebar' ); ?>
	</aside>

	<?php
}

add_action( 'alcatraz_footer', 'alcatraz_output_footer_widget_areas', 8 );
/**
 * Maybe output the Footer widget areas.
 *
 * @since  1.0.0
 */
function alcatraz_output_footer_widget_areas() {

	$footer_widgets = get_theme_mod( 'footer_widget_areas', 3 );

	if ( 0 < (int) $footer_widgets ) {

		echo '<div id="footer-widget-areas" class="footer-widget-areas">';

		for ( $i = 1; $i <= (int) $footer_widgets; $i++ ) {

			$widget_area_id    = 'footer-widget-area-' . $i;
			$widget_area_class = $widget_area_id;

			// Handle inconsistent -x behavior of register_sidebars.
			if ( 1 < (int) $footer_widgets && 1 === $i ) {
				$widget_area_id = 'footer-widget-area';
			}

			if ( is_active_sidebar( $widget_area_id ) ) {

				printf(
					'<section id="%s" class="%s" role="complementary">',
					esc_attr( $widget_area_class ),
					esc_attr( $widget_area_class ) . ' footer-widget-area widget-area'
				);

				dynamic_sidebar( $widget_area_id );

				echo '</section>';
			}
		}

		echo '</div>';
	}
}
