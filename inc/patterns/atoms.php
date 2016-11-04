<?php
/**
 * Pattern Library Atoms.
 *
 * @package alcatraz
 */


/**
 * Build pattern documentation.
 *
 * @param  array  $args  The pattern documentation.
 */
function alcatraz_pattern_doc( $args = array() ) {

	$defaults = array(
		'heading'     => '',
		'description' => '',
		'included_in' => '',
		'function'    => '',
		'output'      => '',
	);
	$args = wp_parse_args( $args, $defaults ); ?>

	<header class="pattern-doc-header">
		<h3 class="pattern-doc-heading"><?php esc_html_e( $args['heading'] ); ?></h3>
		<?php alcatraz_button( array( 'type' => 'button', 'button_text' => 'Show Details', 'class' => 'pattern-doc-toggle' ) ); ?>
	</header>

	<div class="pattern-doc-info">
		<div class="pattern-doc-details">
			<p class="pattern-doc-description"><?php echo wp_kses_post( $args['description'] ); ?></p>
			<?php if ( $args['included_in'] ) : ?>
			<p class="pattern-doc-included-in"><?php esc_html_e( $args['included_in'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="pattern-doc-code">
			<h4 class="pattern-doc-code-heading"><?php esc_html_e( 'Function Call', 'alcatraz' ); ?></h4>
			<pre class="pattern-doc-function"><?php esc_html_e( $args['function'] ); ?></pre>

			<h4 class="pattern-doc-code-heading"><?php esc_html_e( 'HTML Output', 'alcatraz' ); ?></h4>
			<pre class="pattern-doc-output"><?php esc_html_e( $args['output'] ); ?></pre>
		</div>
	</div>

	<?php
}

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
 *
 * @param  array  $args  The button args.
 */
function alcatraz_button( $args = array() ) {

	$defaults = array(
		'type'        => 'button',
		'button_text' => 'Submit',
		'link'        => '',
		'class'       => '',
		'target'      => 'self',
	);
	$args = wp_parse_args( $args, $defaults );

	// Check which type of button to output.
	switch ( $args['type'] ) {

		case 'button' : ?>

			<button class="button <?php esc_attr_e( $args['class'] ); ?>"><?php esc_html_e( $args['button_text'] ); ?></button>

			<?php break;

		case 'submit' : ?>

			<input type="submit" value="<?php esc_attr_e( $args['button_text'] ); ?>" class="button button-submit <?php esc_attr_e( $args['class'] ); ?>" />

			<?php break;

		case 'text' : ?>

			<a href="<?php echo esc_url( $args['link'] ); ?>" class="button button-text <?php esc_attr_e( $args['class'] ); ?>" target="<?php esc_attr_e( $args['target'] ); ?>"><?php esc_html_e( $args['button_text'] ); ?></a>

			<?php break;
	}
}

/**
 * Input attributes
 *
 * @param   array   $args  The input attributes.
 * @return  string         The input attribute string.
 */
function alcatraz_inputs( $args = array() ) {

	$defaults = array(
		'type'          => 'text',
		'value'         => '',
		'placeholder'   => '',
		'required'      => false,
		'autocomplete'  => 'off',
		'class'         => '',
	);
	$args = wp_parse_args( $args, $defaults );

	// Build our attributes array ignoring empty attributes.
	$attributes = array();
	$attributes[] .= 'type=' . $args['type'];

	if ( ! empty( $args['value'] ) ) {
		$attributes[] .= 'value=' . $args['value'];
	}
	if ( ! empty( $args['placeholder'] ) ) {
		$attributes[] .= 'placeholder=' . $args['placeholder'];
	}
	if ( $args['required'] ) {
		$attributes[] .= 'required';
	}
	if ( ! empty( $args['autocomplete'] ) ) {
		$attributes[] .= 'autocomplete=' . $args['autocomplete'];
	}
	if ( ! empty( $args['class'] ) ) {
		$attributes[] .= 'class=' . $args['class'];
	}

	// Convert the array into a string.
	$attributes = implode( ' ', $attributes );

	return $attributes;
}

/**
 * Form elements
 *
 * @param  array  $args  The form element args.
 */
function alcatraz_form_elements( $args = array() ) {

	$defaults = array(
		'tag'          => 'input',
		'type'         => '',
		'value'        => '',
		'placeholder'  => '',
		'required'     => '',
		'autocomplete' => false,
		'options'      => array(
			'Option 1',
			'Option 2',
			'Option 3',
			'Option 4',
		),
		'class'        => '',
	);
	$args = wp_parse_args( $args, $defaults );

	// Determine the type of form element to output.
	switch ( $args['tag'] ) {

		case 'input' :

			// Here we make a call to our alcatraz_inputs function to get the clean attributes.
			$attributes = alcatraz_inputs( array(
				'type'          => $args['type'],
				'value'         => $args['value'],
				'placeholder'   => $args['placeholder'],
				'autocomplete'  => $args['autocomplete'],
				'class'         => $args['class'],
			) ); ?>

			<input <?php esc_attr_e( $attributes ); ?> />

			<?php break;

		case 'textarea' : ?>

			<textarea class="<?php esc_attr_e( $args['class'] ); ?>" placeholder="<?php esc_attr_e( $args['placeholder'] ); ?>"></textarea>

			<?php break;

		case 'select' :

			$options = $args['options']; ?>

			<select class="<?php esc_attr_e( $args['class'] ); ?>">

				<optgroup>

				<?php
				foreach ( $options as $option ) { ?>

					<option><?php esc_html_e( $option ); ?></option>

					<?php
				} ?>

				</optgroup>

			</select>

			<?php break;
	}
}

/**
 * Images
 *
 * @param  array  $args  The image arguments.
 */
function alcatraz_image( $args = array() ) {
	$defaults = array(
		'src'         => 'https://unsplash.it/300/200/?random',
		'size'        => '',
		'use_img_url' => true,
	);
	$args = wp_parse_args( $args, $defaults );

	// Let's figure out the type of image we're working with.
	switch ( $args['use_img_url'] ) {

		case true : ?>

			<img src="<?php echo esc_url( $args['src'] ); ?>" />

			<?php break;

		case false :

			wp_get_attachment_image( $args['size'] );

			break;
	}
}
