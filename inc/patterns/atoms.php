<?php
/**
 * Pattern Library Atoms.
 *
 * @package alcatraz
 */


/**
 * Set the theme colors.
 *
 * @return  array  The theme colors.
 */
function alcatraz_set_theme_colors() {

	$colors = array(
		'alcatraz-blue' => '#0d8bb7',
		'hope'          => '#fff9c0',
		'jelly-bean'    => '#21759b',
	);

	return apply_filters( 'alcatraz_set_colors', $colors );
}

/**
 * Set the theme fonts.
 *
 * @return  array  The theme fonts.
 */
function alcatraz_set_theme_fonts() {

	$fonts = array(
		'primary' => '\'Source Sans Pro\', sans-serif',
		'code'    => '\'Source Code Pro\', Courier, monospace',
	);

	return apply_filters( 'alcatraz_set_fonts', $fonts );
}

/**
 * Buttons
 */
function alcatraz_button() {

	$defaults = array(
		'type'        => 'button',
		'button_text' => 'Submit',
		'link'        => '',
		'class'       => '',
		'target'      => 'self',
	);
	$args = wp_parse_args( (array)$args, $defaults);

	switch ( $args['type'] ) {

		case 'button' : ?>

			<button class="button <?php esc_attr_e( $args['class'] ); ?>"><?php esc_html_e( $args['button_text'] ); ?></button>

			<?php break;

		case 'submit' : ?>

			<input type="submit" value="<?php esc_attr_e( $args['button_text'] ); ?>" class="button button-submit <?php esc_attr_e( $args['class']); ?>" />

			<?php break;

		case 'text' : ?>

			<a href="<?php echo esc_url( $args['link'] ); ?>" class="button button-text <?php esc_attr_e( $args['class'] ); ?>" target="<?php esc_attr_e( $args['target'] ); ?>"><?php esc_html_e( $args['button_text'] ); ?></a>

			<?php break;
	}
}
