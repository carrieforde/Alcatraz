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
		add_action( 'admin_init', array( $this, 'register_settings_and_fields' ) );
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
			array( $this, 'options_page' )
		);
	}

	/**
	 * Output our theme options page.
	 *
	 * @since  1.0.0
	 */
	public function options_page() {
		?>
		<div class="wrap alcatraz-options-page">
			<h1><?php _e( 'Alcatraz Theme Options', 'alcatraz' ) ?></h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'alcatraz_options' ); ?>
				<?php do_settings_sections( 'alcatraz_settings_section' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register our settings and fields.
	 *
	 * @since  1.0.0
	 */
	public function register_settings_and_fields() {

		register_setting(
			'alcatraz_options',
			'alcatraz_options',
			array( $this, 'validate_options' )
		);

		add_settings_section(
			'alcatraz_options_page_settings',
			__( 'Social Media Links', 'alcatraz' ),
			array( $this, 'settings_section' ),
			'alcatraz_settings_section'
		);

	$networks = alcatraz_get_social_networks();

	foreach ( $networks as $network => $network_data ) {
			add_settings_field(
		        $network . '_url',
		        $network_data['display_name'],
		        array( $this, 'field_text' ),
		        'alcatraz_settings_section',
		        'alcatraz_options_page_settings',
		        array(
		            'id'          => $network . '_url',
		            'description' => $network_data['description'],
		        )
		    );
		}
	}

	/**
	 * Output the settings section.
	 *
	 * @since  1.0.0
	 */
	public function settings_section() {
		return;
	}

	/**
	 * Output a text field.
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $args  The array of field args.
	 */
	public function field_text( $args ) {

		// Bail if we don't have an ID.
		if ( empty( $args['id'] ) ) {
			return;
		}

		$option_id          = 'alcatraz-options-' . str_replace( '_', '-', $args['id'] );
		$option_key         = 'alcatraz_options[' . $args['id'] . ']';
		$option_value       = ( ! empty( $this->options[ $args['id'] ] ) ) ? $this->options[ $args['id'] ] : '';
		$option_description = ( ! empty( $args['description'] ) ) ? '<br /><span class="description">' . wp_kses_post( $args['description'] ) . '</span>' : '';

		printf(
			'<input type="text" class="regular-text" id="%s" name="%s" value="%s" />%s',
			esc_attr( $option_id ),
			esc_attr( $option_key ),
			esc_attr( $option_value ),
			$option_description
		);
	}

	/**
	 * Output a checkbox.
	 *
	 * @since 1.0.0
	 *
	 * @param  array  $args  The array of field args.
	 */
	public function field_checkbox( $args ) {

		$option_id          = 'alcatraz-options-' . str_replace( '_', '-', $args['id'] );
		$option_key         = 'alcatraz_options[' . $args['id'] . ']';
		$option_value       = ( ! empty( $this->options[ $args['id'] ] ) ) ? alcatraz_true_or_false( $this->options[ $args['id'] ] ) : '';
		$option_description = ( ! empty( $args['description'] ) ) ? '<br /><span class="description">' . wp_kses_post( $args['description'] ) . '</span>' : '';

		printf(
			'<input type="checkbox" class="checkbox" id="%s" name="%s" value="1" %s />%s',
			esc_attr( $option_id ),
			esc_attr( $option_key ),
			checked( $option_value, 1, false ),
			$option_description
		);
	}

	/**
	 * Validate our options before saving.
	 *
	 * @since   1.0.0
	 *
	 * @param   array  $input  The options to update.
	 *
	 * @return  array          The updated options.
	 */
	public function validate_options( $input ) {

		$options = alcatraz_validate_options( $input );

		return $options;
	}
}
