<?php
/**
 * Alcatraz options page class.
 *
 * @package alcatraz
 *
 * @since   1.0.0
 */

class Alcatraz_Options_Page {

	/**
	 * Our theme options.
	 *
	 * @since  1.0.0
	 */
	private $options;

	/**
	 * The constructor.
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
		$this->options = get_option( 'alcatraz_options' );
	}

	/**
	 * Setup our hooks.
	 *
	 * @since  1.0.0
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'register_options_page' ) );
	}

	/**
	 * Register our options page.
	 *
	 * @since  1.0.0
	 */
	public function register_options_page() {
		add_menu_page(
			__( 'Alcatraz Theme Options', 'alcatraz' ),
			__( 'Theme Options', 'alcatraz' ),
			'manage_options',
			'alcatraz_options_page',
			array(
				$this,
				'options_page'
			)
		);
	}

	/**
	 * Output our theme options page.
	 *
	 * @since  1.0.0
	 */
	public function  options_page() {
		?>
		<div class="wrap alcatraz-options-page">
			<h1><?php _e( 'Alcatraz Theme Options', 'alcatraz' ) ?></h1>
			<form method="post" action="options.php">
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}