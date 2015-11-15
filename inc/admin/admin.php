<?php
/**
 * Alcatraz admin-only functionality.
 *
 * @package alcatraz
 */

// Include CMB2.
require_once ALCATRAZ_PATH . 'lib/cmb2/init.php';

add_action( 'cmb2_admin_init', 'alcatraz_page_options_metabox' );
/**
 * Setup our Page Options metabox.
 *
 * @since  1.0.0
 */
function alcatraz_page_options_metabox() {

	$prefix = '_alcatraz_';

	/**
	 * Initialize the metabox.
	 */
	$page_options = new_cmb2_box( array(
		'id'            => 'page_options_metabox',
		'title'         => __( 'Page Options', 'alcatraz' ),
		'object_types'  => array( 'page' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	// Page layout.
	$page_options->add_field( array(
		'name'    => __( 'Layout', 'alcatraz' ),
		'desc'    => __( 'Select the layout for this page', 'alcatraz' ),
		'id'      => $prefix . 'page_layout',
		'type'    => 'radio',
		'options' => array(
			'default'       => __( 'Default', 'alcatraz' ),
			'full-width'    => __( 'Full Width', 'alcatraz' ),
			'left-sidebar'  => __( 'Left Sidebar', 'alcatraz' ),
			'right-sidebar' => __( 'Right Sidebar', 'alcatraz' ),
		),
	) );

	// Body class.
	$page_options->add_field( array(
		'name' => __( 'Body Class', 'alcatraz' ),
		'desc' => __( 'Add a custom class to the &lt;body&gt; tag for this page', 'alcatraz' ),
		'id'   => $prefix . 'body_class',
		'type' => 'text',
	) );
}