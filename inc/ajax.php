<?php
/**
 * Alcatraz Ajax.
 *
 * @package alcatraz
 */

add_action( 'wp_ajax_alcatraz_hide_activation_notice', 'alcatraz_hide_admin_notice' );
/**
 * Ajax handler for hiding the admin notice.
 *
 * @since  1.0.0
 */
function alcatraz_hide_admin_notice() {

	$options = get_option( 'alcatraz_options' );

	$options['show_activation_notice'] = 0;

	update_option( 'alcatraz_options', $options, true );

	wp_die();
}
