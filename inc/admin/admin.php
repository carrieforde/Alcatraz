<?php
/**
 * Alcatraz admin-only functionality.
 *
 * Everything in this file is only run if is_admin() is true.
 *
 * @package alcatraz
 */

add_action( 'admin_enqueue_scripts', 'alcatraz_admin_enqueue_scripts' );
/**
 * Enqueue our admin JS.
 *
 * @since 1.0.0
 *
 * @param string $hook The page being displayed.
 */
function alcatraz_admin_enqueue_scripts( $hook ) {

	wp_enqueue_script(
		'alcatraz-admin-scripts',
		ALCATRAZ_URL . 'dist/admin-bundle.js',
		array( 'jquery' ),
		ALCATRAZ_VERSION,
		true
	);
}

add_action( 'admin_notices', 'alcatraz_activation_notice' );
/**
 * Show an activation notice.
 *
 * @since  1.0.0
 */
function alcatraz_activation_notice() {

	$options = get_option( 'alcatraz_options' );

	if ( $options['show_activation_notice'] ) {

		$customizer_link = sprintf(
			'<a href="%s">%s</a>',
			esc_url( admin_url( 'customize.php' ) ),
			__( 'Customizer', 'alcatraz' )
		);

		$documentation_link = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			'https://github.com/carrieforde/Alcatraz/wiki',
			__( 'Alcatraz documentation on Github', 'alcatraz' )
		);

		?>
		<div id="alcatraz-activation-notice" class="updated notice is-dismissible" style="padding-bottom: 5px;">
			<h2><?php _e( 'Welcome to Alcatraz', 'alcatraz' ); // WPCS: XSS OK. ?></h2>
			<p><?php _e( 'Get started by configuring visual options in the', 'alcatraz' ); // WPCS: XSS OK. ?> <?php echo $customizer_link; // WPCS: XSS OK. ?></p>
			<p><?php _e( 'For development resources visit the', 'alcatraz' ); // WPCS: XSS OK. ?> <?php echo $documentation_link; // WPCS: XSS OK. ?></p>
		</div>
		<?php
	}
}
