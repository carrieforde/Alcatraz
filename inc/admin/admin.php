<?php
/**
 * Alcatraz admin-only functionality.
 *
 * @package alcatraz
 */

// Include our theme options page.
require_once ALCATRAZ_PATH . 'inc/admin/options-page.php';

// Include CMB2.
require_once ALCATRAZ_PATH . 'lib/cmb2/init.php';

/**
 * Initialize our options page class.
 *
 * @since  1.0.0
 */
$options_page = new Alcatraz_Options_Page();
$options_page->init();

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
		'type'    => 'select',
		'options' => array(
			'default'       => __( 'Default', 'alcatraz' ),
			'no-sidebar'    => __( 'No Sidebar', 'alcatraz' ),
			'left-sidebar'  => __( 'Left Sidebar', 'alcatraz' ),
			'right-sidebar' => __( 'Right Sidebar', 'alcatraz' ),
		),
	) );

	// Transparent header.
	$page_options->add_field( array(
		'name' => __( 'Transparent Header', 'alcatraz' ),
		'desc' => __( 'Position the page content at the top of the screen and make the header transparent', 'alcatraz' ),
		'id'   => $prefix . 'transparent_header',
		'type' => 'checkbox',
	) );

	// Header text color.
	$page_options->add_field( array(
		'name'    => __( 'Header Text Color', 'alcatraz' ),
		'desc'    => __( 'Select a Header Text Color for this page', 'alcatraz' ),
		'id'      => $prefix . 'header_text_color',
		'type'    => 'select',
		'options' => alcatraz_get_text_colors( 'header' ),
	) );

	// Body class.
	$page_options->add_field( array(
		'name' => __( 'Body Class', 'alcatraz' ),
		'desc' => __( 'Add a custom class to the &lt;body&gt; tag for this page', 'alcatraz' ),
		'id'   => $prefix . 'body_class',
		'type' => 'text',
	) );
}
