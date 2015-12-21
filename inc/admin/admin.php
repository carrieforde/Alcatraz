<?php
/**
 * Alcatraz admin-only functionality.
 *
 * Everything in this file is only run if is_admin() is true.
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

add_action( 'admin_enqueue_scripts', 'alcatraz_admin_enqueue_scripts' );
/**
 * Enqueue our admin JS.
 *
 * @since  1.0.0
 *
 * @param  string  $hook  The page being displayed.
 */
function alcatraz_admin_enqueue_scripts( $hook ) {

	wp_enqueue_script(
		'alcatraz-admin-scripts',
		ALCATRAZ_URL . 'js/alcatraz-admin.js',
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

		$options_page_link = sprintf(
			'<a href="%s">%s</a>',
			esc_url( admin_url( 'admin.php?page=alcatraz_options_page' ) ),
			__( 'Options Page', 'alcatraz' )
		);

		$documentation_link = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			'https://github.com/carrieforde/Alcatraz/wiki',
			__( 'Alcatraz documentation on Github', 'alcatraz' )
		);

		?>
		<div id="alcatraz-activation-notice" class="updated notice is-dismissible" style="padding-bottom: 5px;">
			<h2><?php _e( 'Welcome to Alcatraz', 'alcatraz' ); ?></h2>
			<p><?php _e( 'Get started by configuring visual options in the', 'alcatraz' ); ?> <?php echo $customizer_link; ?></p>
			<p><?php _e( 'All non-visual options can be found on the', 'alcatraz' ); ?> <?php echo $options_page_link; ?></p>
			<p><?php _e( 'For development resources visit the', 'alcatraz' ); ?> <?php echo $documentation_link; ?></p>
		</div>
		<?php
	}
}

add_action( 'admin_init', 'alcatraz_add_editor_styles' );
/**
 * Include our theme CSS in the TinyMCE editor.
 *
 * @since  1.0.0
 */
function alcatraz_add_editor_styles() {

	global $alcatraz_google_fonts;

	add_editor_style( $alcatraz_google_fonts );
	add_editor_style( get_stylesheet_uri() );
}

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
