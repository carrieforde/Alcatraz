<?php
/**
 * Pattern Library Atoms.
 *
 * @package alcatraz
 */


/**
 * Build pattern library documentation.
 *
 * @param  array  $args  The pattern documentation.
 */
function alcatraz_pattern_doc( $args = array() ) {

	$defaults = array(
		'heading'           => '',
		'description'       => '',
		'patterns_included' => '',
		'function'          => '',
		'output'            => '',
		'params'            => array(),
		'args'              => array(),
	);
	$args = wp_parse_args( $args, $defaults ); ?>

	<header class="pattern-doc-header">
		<h3 class="pattern-doc-heading"><?php esc_html_e( $args['heading'] ); ?></h3>
		<?php echo wp_kses_post( alcatraz_button( array( 'type' => 'button', 'button_text' => 'Show Details', 'class' => 'pattern-doc-toggle' ) ) ); ?>
	</header>

	<div class="pattern-doc-info">
		<div class="pattern-doc-details">
			<p><?php echo wp_kses_post( $args['description'] ); ?></p>
			<?php if ( $args['patterns_included'] ) : ?>
			<p><?php esc_html_e( $args['patterns_included'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="pattern-doc-details">
			<h4><?php esc_html_e( 'Template Tag', 'alcatraz' ); ?></h4>
			<pre>&lt;?php <?php esc_html_e( $args['function'] ); ?>; ?&gt;</pre>

			<h4><?php esc_html_e( 'HTML Output', 'alcatraz' ); ?></h4>
			<pre><?php esc_html_e( trim( $args['output'] ) ); ?></pre>
		</div>

		<div class="pattern-doc-details">
			<h4><?php esc_html_e( 'Params', 'alcatraz' ); ?></h4>
			<?php if ( $args['params'] ) : ?>
				<?php foreach ( $args['params'] as $key => $value ) : ?>
					<p><code><?php esc_html_e( $key ); ?></code> <?php esc_html_e( $value ); ?></p>
				<?php endforeach; ?>
			<?php endif; ?>

			<h4><?php esc_html_e( 'Arguments', 'alcatraz' ); ?></h4>
			<?php if ( $args['args'] ) : ?>
				<?php foreach ( $args['args'] as $key => $value ) : ?>
					<p><code><?php esc_html_e( $key ); ?></code> <?php esc_html_e( $value ); ?></p>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>

	<?php // The actual pattern. ?>
	<div class="pattern-doc-pattern">
		<?php echo wp_kses_post( $args['output'] ); ?>
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

			<?php ob_start(); ?>

			<button class="button <?php esc_attr_e( $args['class'] ); ?>"><?php esc_html_e( $args['button_text'] ); ?></button>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'submit' : ?>

			<?php ob_start(); ?>

			<input type="submit" value="<?php esc_attr_e( $args['button_text'] ); ?>" class="button button-submit <?php esc_attr_e( $args['class'] ); ?>" />

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'text' : ?>

			<?php ob_start(); ?>

			<a href="<?php echo esc_url( $args['link'] ); ?>" class="button button-text <?php esc_attr_e( $args['class'] ); ?>" target="<?php esc_attr_e( $args['target'] ); ?>"><?php esc_html_e( $args['button_text'] ); ?></a>

			<?php return ob_get_clean(); ?>

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

			<?php ob_start(); ?>

			<input <?php esc_attr_e( $attributes ); ?> />

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'textarea' : ?>

			<?php ob_start(); ?>

			<textarea class="<?php esc_attr_e( $args['class'] ); ?>" placeholder="<?php esc_attr_e( $args['placeholder'] ); ?>"></textarea>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'select' :

			$options = $args['options']; ?>

			<?php ob_start(); ?>

			<select class="<?php esc_attr_e( $args['class'] ); ?>">

				<optgroup>

				<?php
				foreach ( $options as $option ) : ?>

					<option><?php esc_html_e( $option ); ?></option>

				<?php endforeach; ?>

				</optgroup>

			</select>

			<?php return ob_get_clean(); ?>

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

			<?php ob_start(); ?>

			<img src="<?php echo esc_url( $args['src'] ); ?>" />

			<?php return ob_get_clean(); ?>

		<?php break;

		case false :

			return wp_get_attachment_image( $args['size'] );

		break;
	}
}


function alcatraz_typography( $args = array() ) {

	$defaults = array(
		'element' => '',
	);
	wp_parse_args( $args, $defaults );

	// Determine which group of tyopgraphy elements to output.
	switch ( $args['element'] ) {

		case 'headings' : ?>

			<?php ob_start(); ?>

			<header>
				<h1><?php esc_html_e( 'Heading 1', 'alcatraz' ); ?></h1>
				<h2><?php esc_html_e( 'Heading 2', 'alcatraz' ); ?></h2>
				<h3><?php esc_html_e( 'Heading 3', 'alcatraz' ); ?></h3>
				<h4><?php esc_html_e( 'Heading 4', 'alcatraz' ); ?></h4>
				<h5><?php esc_html_e( 'Heading 5', 'alcatraz' ); ?></h5>
				<h6><?php esc_html_e( 'Heading 6', 'alcatraz' ); ?></h6>
			</header>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'hr' : ?>

			<?php ob_start(); ?>

			<hr />

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'inline' : ?>

			<?php ob_start(); ?>

			<div class="wrap">
				<p><a href="#"><?php esc_html_e( 'This is a text link', 'alcatraz' ); ?></a></p>

				<p><strong><?php esc_html_e( 'Strong is used to indicate strong importance', 'alcatraz' ); ?></strong></p>

				<p><em><?php esc_html_e( 'This text has added emphasis', 'alcatraz' ) ?></em></p>

				<p><?php esc_html_e( 'The ', 'alcatraz' ); ?><b><?php esc_html_e( 'b element', 'alcatraz' ); ?></b><?php esc_html_e( ' is stylistically different from normal text, without any special importance', 'alcatraz' ); ?></p>

				<p><?php esc_html_e( 'The ', 'alcatraz' ); ?><i><?php esc_html_e( 'i element', 'alcatraz' ); ?></i><?php esc_html_e( ' is text that is set off from the normal text', 'alcatraz' ); ?></p>

				<p><?php esc_html_e( 'The ', 'alcatraz' ); ?><u><?php esc_html_e( 'u element', 'alcatraz' ); ?></u><?php esc_html_e( ' is text with an unarticulated, though explicitly rendered, non-textual annotation', 'alcatraz' ); ?></p>

				<p><del><?php esc_html_e( 'This text is deleted' ); ?></del><?php esc_html_e( ' and ', 'alcatraz' ); ?><ins><?php esc_html_e( 'this text is inserted', 'alcatraz' ); ?></ins></p>

				<p><s><?php esc_html_e( 'This text as a strikethrough', 'alcatraz' ); ?></s></p>

				<p><?php esc_html_e( 'Superscript', 'alcatraz' ); ?><sup>&reg;</sup></p>

				<p><?php esc_html_e( 'Subscript for things like H', 'alcatraz' ); ?><sub><?php esc_html_e( '2', 'alcatraz' ); ?></sub><?php esc_html_e( 'O', 'alcatraz' ); ?></p>

				<p><small><?php esc_html_e( 'This small text is small for fine print, etc', 'alatraz-components' ); ?></small></p>

				<p><?php esc_html_e( 'Abbreviation: ', 'alcatraz' ); ?><abbr title="<?php esc_attr_e( 'HyperText Markup Language', 'alcatraz' ); ?>">HTML</abbr></p>

				<p><?php esc_html_e( 'Keyboard input: ', 'alcatraz' ); ?><kbd><?php esc_html_e( 'Cmd', 'alcatraz' ); ?></kbd></p>

				<p><q cite="<?php esc_url( 'https://developer.mozilla.org/en-US/docs/HTML/Element/q' ); ?>"><?php esc_html_e( 'This text is a short inline quotation', 'alcatraz' ); ?></q></p>

				<p><cite><?php esc_html_e( 'This is a citation', 'alcatraz' ); ?></cite></p>

				<p><?php esc_html_e( 'The ', 'alcatraz' ); ?><dfn><?php esc_html_e( 'dfn element', 'alcatraz' ); ?></dfn><?php esc_html_e( ' indicates a definition.' ); ?></p>

				<p><?php esc_html_e( 'The ', 'alcatraz' ); ?><mark><?php esc_html_e( 'mark element', 'alcatraz' ); ?></mark><?php esc_html_e( ' indicates a highlight' ); ?></p>

				<p><code><?php esc_html_e( 'This is what inline code looks like', 'alcatraz' ); ?></code></p>

				<p><samp><?php esc_html_e( 'This is sample output from a computer program', 'alcatraz' ); ?></samp></p>

				<p><?php esc_html_e( 'The ', 'alcatraz' ); ?><var><?php esc_html_e( 'variable element', 'alcatraz' ); ?></var><?php esc_html_e( ' such as ', 'alcatraz' ); ?><var><?php esc_html_e( 'x', 'alcatraz' ); ?></var><?php esc_html_e( ' = ', 'alcatraz' ); ?><var><?php esc_html_e( 'y', 'alcatraz' ); ?></var></p>
			</div>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'paragraph' : ?>

			<?php ob_start(); ?>

			<p><?php esc_html_e( 'A paragraph (from the Greek paragraphos, "to write beside" or "written beside") is a self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences. Though not required by the syntax of any language, paragraphs are usually an expected part of formal writing, used to organize longer prose.', 'alcatraz' ); ?></p>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'preformatted' : ?>

			<?php ob_start(); ?>

			<?php // Preformatted text take spaces and tabs into account, so this looks a bit goofy! ?>
			<pre><?php esc_html_e( 'P R E F O R M A T T E D T E X T
! " # $ % &amp; \' ( ) * + , - . /
0 1 2 3 4 5 6 7 8 9 : ; &lt; = &gt; ?
@ A B C D E F G H I J K L M N O
P Q R S T U V W X Y Z [ \ ] ^ _
` a b c d e f g h i j k l m n o
p q r s t u v w x y z { | } ~', 'alcatraz' ); ?></pre>

			<?php return ob_get_clean(); ?>

		<?php break;
	}
}
