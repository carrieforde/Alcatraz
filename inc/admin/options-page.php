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
			array( $this, 'alcatraz_validate_options' )
		);

		add_settings_section(
			'social_media_links',
			__( 'Social Media Links', 'alcatraz' ),
			array( $this, 'settings_section' ),
			'alcatraz_settings_section'
		);

		add_settings_field(
			'email_url',
			__( 'Email', 'alcatraz' ),
			array( $this, 'field_text' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'email_url',
				'description' => __( 'Enter your email address (mailto:me@example.com)', 'alcatraz' ),
			)
		);

		add_settings_field(
			'facebook_url',
			__( 'Facebook', 'alcatraz' ),
			array( $this, 'field_text' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'facebook_url',
				'description' => __( 'Enter your Facebook profile URL', 'alcatraz' ),
			)
		);

		add_settings_field(
			'twitter_url',
			__( 'Twitter', 'alcatraz' ),
			array( $this, 'field_text' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'twitter_url',
				'description' => __( 'Enter your Twitter profile URL', 'alcatraz' ),
			)
		);

		add_settings_field(
			'instagram_url',
			__( 'Instagram', 'alcatraz' ),
			array( $this, 'field_text' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'instagram_url',
				'description' => __( 'Enter your Instagram profile URL', 'alcatraz' ),
			)
		);

		add_settings_field(
			'pinterest_url',
			__( 'Pinterest', 'alcatraz' ),
			array( $this, 'field_text' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'pinterest_url',
				'description' => __( 'Enter your Pinterest profile URL', 'alcatraz' ),
			)
		);

		add_settings_field(
			'youtube_url',
			__( 'Youtube', 'alcatraz' ),
			array( $this, 'field_text' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'youtube_url',
				'description' => __( 'Enter your YouTube channel URL', 'alcatraz' ),
			)
		);

		add_settings_field(
			'show_social_urls',
			__( 'Show Social URLs', 'alcatraz' ),
			array( $this, 'field_checkbox' ),
			'alcatraz_settings_section',
			'social_media_links',
			array(
				'id'          => 'show_social_urls',
				'description' => __( 'Show Social Icons in Footer?', 'alcatraz' ),
			)
		);
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

		if ( empty( $args['id'] ) ) {
			return;
		}

		$option_id          = 'alcatraz-options-' . str_replace( '_', '-', $args['id'] );
		$option_key         = 'alcatraz_options[' . $args['id'] . ']';
		$option_value       = ( ! empty( $this->options[ $args['id'] ] ) ) ? $this->options[ $args['id'] ] : '';
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
	 * Because we're storing all of our options under a single key, we need
	 * to also validate our Customizer options here, which allows us to avoid
	 * having to specify sanitize_callback functions in our customizer.php file.
	 *
	 * @since  1.0.0
	 */
	public function alcatraz_validate_options( $input ) {

		// Start with any existing options.
		$options = get_option( 'alcatraz_options' );

		// Update options on the options page.
		if ( ! empty( $input['email_url'] ) ) {
			$options['email_url']     = sanitize_text_field( $input['email_url'] );
		}
		if ( ! empty( $input['facebook_url'] ) ) {
			$options['facebook_url']  = sanitize_text_field( $input['facebook_url'] );
		}
		if ( ! empty( $input['twitter_url'] ) ) {
			$options['twitter_url']   = sanitize_text_field( $input['twitter_url'] );
		}
		if ( ! empty( $input['instagram_url'] ) ) {
			$options['instagram_url'] = sanitize_text_field( $input['instagram_url'] );
		}
		if ( ! empty( $input['pinterest_url'] ) ) {
			$options['pinterest_url'] = sanitize_text_field( $input['pinterest_url'] );
		}
		if ( ! empty( $input['youtube_url'] ) ) {
			$options['youtube_url']   = sanitize_text_field( $input['youtube_url'] );
		}
		if ( ! empty( $input['show_social_urls'] ) ) {
			$options['show_social_urls'] = absint( $input['show_social_urls'] );
		}

		// Update options in the Customizer.
		if ( ! empty( $input['site_layout'] ) ) {
			$options['site_layout'] = sanitize_text_field( $input['site_layout'] );
		}
		if ( ! empty( $input['page_layout'] ) ) {
			$options['page_layout'] = sanitize_text_field( $input['page_layout'] );
		}
		if ( ! empty( $input['page_banner_widget_area'] ) ) {
			$options['page_banner_widget_area'] = absint( $input['page_banner_widget_area'] );
		}
		if ( ! empty( $input['header_style'] ) ) {
			$options['header_style'] = sanitize_text_field( $input['header_style'] );
		}
		if ( ! empty( $input['mobile_nav_toggle_style'] ) ) {
			$options['mobile_nav_toggle_style'] = sanitize_text_field( $input['mobile_nav_toggle_style'] );
		}
		if ( ! empty( $input['mobile_nav_style'] ) ) {
			$options['mobile_nav_style'] = sanitize_text_field( $input['mobile_nav_style'] );
		}
		if ( ! empty( $input['sub_menu_toggle_style'] ) ) {
			$options['sub_menu_toggle_style'] = sanitize_text_field( $input['sub_menu_toggle_style'] );
		}
		if ( ! empty( $input['logo_id'] ) ) {
			$options['logo_id'] = alcatraz_empty_or_int( $input['logo_id'] );
		}
		if ( ! empty( $input['mobile_logo_id'] ) ) {
			$options['mobile_logo_id'] = alcatraz_empty_or_int( $input['mobile_logo_id'] );
		}
		if ( ! empty( $input['footer_widget_areas'] ) ) {
			$options['footer_widget_areas'] = absint( $input['footer_widget_areas'] );
		}
		if ( ! empty( $input['footer_bottom'] ) ) {
			$options['footer_bottom'] = sanitize_text_field( $input['footer_bottom'] );
		}

		return $options;
	}
}
