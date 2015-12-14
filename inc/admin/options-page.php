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
		add_action( 'admin_init', array( $this, 'alcatraz_admin_init' ) );
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
	public function options_page() {
		?>
		<div class="wrap alcatraz-options-page">
			<h1><?php _e( 'Alcatraz Theme Options', 'alcatraz' ) ?></h1>
				<form method="post" action="options.php">
					<?php settings_fields('alcatraz_options'); ?>
					<?php do_settings_sections('alcatraz_settings_section'); ?>
					<?php submit_button(); ?>
				</form>
		</div>
		<?php
	}

	// add the admin settings and such
	public function alcatraz_admin_init() {
		register_setting(
			'alcatraz_options',
			'alcatraz_options',
			array( $this, 'alcatraz_options_validate' )
		);

		add_settings_section(
			'social_media_links',
			__('Social Media Links', 'alcatraz_settings_section'),
			array( $this, 'settings_section' ),
			'alcatraz_settings_section'
		);

		add_settings_field(
			'facebook',
			__('Facebook', 'alcatraz_settings_section'),
			array( $this, 'facebook_callback' ),
			'alcatraz_settings_section',
			'social_media_links'
		);

		add_settings_field(
			'twitter',
			__('Twitter', 'alcatraz_settings_section'),
			array( $this, 'twitter_callback' ),
			'alcatraz_settings_section',
			'social_media_links'
		);

		add_settings_field(
			'instagram',
			__('Instagram', 'alcatraz_settings_section'),
			array( $this, 'instagram_callback' ),
			'alcatraz_settings_section',
			'social_media_links'
		);

		add_settings_field(
			'pinterest',
			__('Pinterest', 'alcatraz_settings_section'),
			array( $this, 'pinterest_callback' ),
			'alcatraz_settings_section',
			'social_media_links'
		);

		add_settings_field(
			'youtube',
			__('Youtube', 'alcatraz_settings_section'),
			array( $this, 'youtube_callback' ),
			'alcatraz_settings_section',
			'social_media_links'
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
     * Output our facebook field.
     *
     * @since  1.0.0
     */
    public function facebook_callback() {

		$options = get_option( 'alcatraz_options' );

		$facebook = $options['facebook'];

		printf(
			'<input id="%s-facebook-field" name="%s" type="text" value="%s" name="alcatraz-link" /><br />',
			'alcatraz-settings',
			'alcatraz_options' . '[facebook]',
			esc_url( $facebook )
		);

	}

	/**
     * Output our twitter field.
     *
     * @since  1.0.0
     */
    public function twitter_callback() {

		$options = get_option( 'alcatraz_options' );

		$twitter = $options['twitter'];

		printf(
			'<input id="%s-twitter-field" name="%s" type="text" value="%s" name="alcatraz-link" /><br />',
			'alcatraz-settings',
			'alcatraz_options' . '[twitter]',
			esc_url( $twitter )
		);

	}

	/**
     * Output our instagram field.
     *
     * @since  1.0.0
     */
    public function instagram_callback() {

		$options = get_option( 'alcatraz_options' );

		$instagram = $options['instagram'];

		printf(
			'<input id="%s-instagram-field" name="%s" type="text" value="%s" name="alcatraz-link" /><br />',
			'alcatraz-settings',
			'alcatraz_options' . '[instagram]',
			esc_url( $instagram )
		);

	}

	/**
     * Output our pinterest field.
     *
     * @since  1.0.0
     */
    public function pinterest_callback() {

		$options = get_option( 'alcatraz_options' );

		$pinterest = $options['pinterest'];

		printf(
			'<input id="%s-pinterest-field" name="%s" type="text" value="%s" name="alcatraz-link" /><br />',
			'alcatraz-settings',
			'alcatraz_options' . '[pinterest]',
			esc_url( $pinterest )
		);

	}

	/**
     * Output our youtube field.
     *
     * @since  1.0.0
     */
    public function youtube_callback() {

		$options = get_option( 'alcatraz_options' );

		$youtube = $options['youtube'];

		printf(
			'<input id="%s-youtube-field" name="%s" type="text" value="%s" name="alcatraz-link" /><br />',
			'alcatraz-settings',
			'alcatraz_options' . '[youtube]',
			esc_url( $youtube )
		);

	}

	/**
    * Validate our settings before saving.
    *
    * @since  1.0.0
    */
    public function alcatraz_options_validate( $input ) {

    	$new_input = array();

		$new_input['facebook'] = ( isset( $input['facebook'] ) ) ? wp_kses_post( $input['facebook'] ) : '';
		$new_input['twitter'] = ( isset( $input['twitter'] ) ) ? wp_kses_post( $input['twitter'] ) : '';
		$new_input['instagram'] = ( isset( $input['instagram'] ) ) ? wp_kses_post( $input['instagram'] ) : '';
		$new_input['pinterest'] = ( isset( $input['pinterest'] ) ) ? wp_kses_post( $input['pinterest'] ) : '';
		$new_input['youtube'] = ( isset( $input['youtube'] ) ) ? wp_kses_post( $input['youtube'] ) : '';

        return $new_input;
    }

}