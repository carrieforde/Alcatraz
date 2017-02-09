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
	$args = wp_parse_args( $args, $defaults );

	// Create a unique wrapper class based on the doc heading.
	$class = str_replace( ' ', '-', strtolower( $args['heading'] ) );

	// Grab our allowed HTML tags.
	$allowed_tags = alcatraz_pattern_allowed_html(); ?>

	<div class="pattern-doc pattern-doc--<?php echo esc_attr( $class ); ?>">
		<header class="pattern-doc__header">
			<h3><?php echo esc_html( $args['heading'] ); ?></h3>
			<?php echo wp_kses_post( alcatraz_button( array( 'type' => 'button', 'button_text' => 'Show Details', 'class' => 'pattern-doc__toggle' ) ) ); ?>
		</header>

		<div class="pattern-doc__info">
			<?php if ( ! empty( $args['description'] ) || ! empty( $args['patterns_included'] ) ) : ?>
			<div class="pattern-doc__details">
				<p><?php echo wp_kses_post( $args['description'] ); ?></p>

				<?php if ( ! empty( $args['patterns_included'] ) ) : ?>
				<p><?php echo esc_html( $args['patterns_included'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['function'] ) || ! empty( $args['output'] ) ) : ?>
			<div class="pattern-doc__details">
				<?php if ( ! empty( $args['function'] ) ) : ?>
				<h4><?php esc_html_e( 'Template Tag', 'alcatraz' ); ?></h4>
				<pre>&lt;?php <?php echo esc_html( $args['function'] ); ?>; ?&gt;</pre>
				<?php endif; ?>

				<?php if ( ! empty( $args['output'] ) ) : ?>
				<h4><?php esc_html_e( 'HTML Output', 'alcatraz' ); ?></h4>
				<pre><?php echo esc_html( trim( $args['output'] ) ); ?></pre>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['params'] ) || ! empty( $args['args'] ) ) : ?>
			<div class="pattern-doc__details">
				<?php if ( ! empty( $args['params'] ) ) : ?>
				<h4><?php esc_html_e( 'Params', 'alcatraz' ); ?></h4>
					<?php foreach ( $args['params'] as $key => $value ) : ?>
						<p><code><?php echo esc_html( $key ); ?></code> <?php echo esc_html( $value ); ?></p>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php if ( ! empty( $args['args'] ) ) : ?>
				<h4><?php esc_html_e( 'Arguments', 'alcatraz' ); ?></h4>
					<?php foreach ( $args['args'] as $key => $value ) : ?>
						<p><code><?php echo esc_html( $key ); ?></code> <?php echo esc_html( $value ); ?></p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>

		<?php // The actual pattern. ?>
		<div class="pattern-doc__output">
			<?php echo wp_kses( $args['output'], $allowed_tags ); ?>
		</div>
	</div>

	<?php
}

/**
 * Set HTML tags allowed for patterns.
 *
 * @return  array  The HTML tags allowed.
 */
function alcatraz_pattern_allowed_html() {

	$allowed_tags = array_merge( wp_kses_allowed_html( 'post' ), array(
		'input' => array(
			'type'         => true,
			'name'         => true,
			'value'        => true,
			'placeholder'  => true,
			'required'     => true,
			'autocomplete' => true,
			'class'        => true,
		),
		'select' => array(
			'class' => true,
		),
		'optgroup' => array(
			'class' => true,
		),
		'option' => array(
			'class' => true,
		),
		'article' => array(
			'id' => true,
			'class' => true,
		),
	) );

	return apply_filters( 'alcatraz_set_allowed_html', $allowed_tags );
}

/**
 * Build pattern documentation for globals.
 *
 * @param  array  The args.
 */
function alcatraz_global_pattern( $args = array() ) {

	$defaults = array(
		'global_type' => '',
		'heading'     => '',
		'description' => '',
	);
	$args = wp_parse_args( $args, $defaults );

	// Create a unique wrapper class based on the doc heading.
	$class = str_replace( ' ', '-', strtolower( $args['heading'] ) );

	switch ( $args['global_type'] ) :

		case 'colors' :

			$colors = alcatraz_set_theme_colors(); ?>

			<div class="pattern-doc pattern-doc--<?php echo esc_attr( $args['heading'] ); ?>">

				<header class="pattern-doc__header">
					<h3><?php echo esc_html( $args['heading'] ); ?></h3>
					<?php if ( ! empty( $args['description'] ) ) : ?>
						<?php echo wp_kses_post( alcatraz_button( array( 'type' => 'button', 'button_text' => 'Show Details', 'class' => 'pattern-doc__toggle' ) ) ); ?>
					<?php endif; ?>
				</header>

				<?php if ( ! empty( $args['description'] ) ) : ?>
				<div class="pattern-doc__info">
					<div class="pattern-doc__details">
						<p><?php echo wp_kses_post( $args['description'] ); ?></p>
					</div>
				</div>
				<?php endif; ?>

				<div class="pattern-doc__output">

					<?php foreach ( $colors as $group => $colors ) : ?>

						<div class="color-group">
							<h4 class="color-group__heading"><?php echo esc_html( $group ); ?></h4>
							<?php foreach ( $colors as $key => $value ) : ?>
							<div class="color">
								<div class="color__chip" style="background: <?php echo esc_attr( $value ); ?>"></div>
								<span class="color__name">$<?php echo esc_html( $key ); ?> : <?php echo esc_html( $value ); ?></span>
							</div>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php break;

		case 'fonts' :

			$fonts = alcatraz_set_theme_fonts(); ?>

			<div class="pattern-doc pattern-doc--<?php echo esc_attr( $args['heading'] ); ?>">

				<header class="pattern-doc__header">
					<h3><?php echo esc_html( $args['heading'] ); ?></h3>
					<?php if ( ! empty( $args['description'] ) ) : ?>
						<?php echo wp_kses_post( alcatraz_button( array( 'type' => 'button', 'button_text' => 'Show Details', 'class' => 'pattern-doc__toggle' ) ) ); ?>
					<?php endif; ?>
				</header>

				<?php if ( ! empty( $args['description'] ) ) : ?>
				<div class="pattern-doc__info">
					<div class="pattern-doc__details">
						<p><?php echo wp_kses_post( $args['description'] ); ?></p>
					</div>
				</div>
				<?php endif; ?>

				<div class="pattern-doc__output">
					<?php foreach ( $fonts as $key => $value ) : ?>
					<div class="font-stack">

						<div style="font-family: <?php echo esc_attr( $value ); ?>">$<?php echo esc_html( $key ); ?>: <?php echo esc_html( $value ); ?></div>

						<div style="font-family: <?php echo esc_attr( $value ); ?>"><em>$<?php echo esc_html( $key ); ?>: <?php echo esc_html( $value ); ?></em></div>

						<div style="font-family: <?php echo esc_attr( $value ); ?>"><strong>$<?php echo esc_html( $key ); ?>: <?php echo esc_html( $value ); ?></strong></div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php break;

	endswitch;
}

/**
 * Set the theme colors.
 *
 * @return  array  The theme colors.
 */
function alcatraz_set_theme_colors() {

	$colors = array(
		'Brand Colors'   => array( 'alcatraz-blue' => '#0d8bb7' ),
		'Neutral Colors' => array(
			'true-white'         => '#fff',
			'white-smoke'        => '#f1f1f1',
			'mist'               => '#ddd',
			'silver'             => '#c0c0c0',
			'sf-fog'             => '#95a0a3',
			'dim-gray'           => '#666',
			'prision-cell-gray'  => '#535d65',
			'true-black'         => '#000',
		),
		'Utility Colors' => array(
			'hope'       => '#fff9c0',
			'jelly-bean' => '#21759b',
		),
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
		'source-sans-pro' => '\'Source Sans Pro\', sans-serif',
		'source-code-pro' => '\'Source Code Pro\', Courier, monospace',
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

			<button class="button <?php echo esc_attr( $args['class'] ); ?>"><?php echo esc_html( $args['button_text'] ); ?></button>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'submit' : ?>

			<?php ob_start(); ?>

			<input type="submit" value="<?php echo esc_attr( $args['button_text'] ); ?>" class="button button-submit <?php echo esc_attr( $args['class'] ); ?>" />

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'text' : ?>

			<?php ob_start(); ?>

			<a href="<?php echo esc_url( $args['link'] ); ?>" class="button-text <?php echo esc_attr( $args['class'] ); ?>" target="<?php echo esc_attr( $args['target'] ); ?>"><?php echo esc_html( $args['button_text'] ); ?></a>

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
		'name'          => '',
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

	if ( ! empty( $args['name'] ) ) {
		$attributes[] .= 'name=' . $args['name'];
	}
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
		'name'         => '',
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
				'name'          => $args['name'],
				'value'         => $args['value'],
				'placeholder'   => $args['placeholder'],
				'autocomplete'  => $args['autocomplete'],
				'class'         => $args['class'],
			) ); ?>

			<?php ob_start(); ?>

			<input <?php echo esc_attr( $attributes ); ?>>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'textarea' : ?>

			<?php ob_start(); ?>

			<textarea class="<?php echo esc_attr( $args['class'] ); ?>" placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"></textarea>

			<?php return ob_get_clean(); ?>

		<?php break;

		case 'select' :

			$options = $args['options']; ?>

			<?php ob_start(); ?>

			<select class="<?php echo esc_attr( $args['class'] ); ?>">

				<optgroup>
				<?php foreach ( $options as $option ) : ?>

					<option><?php echo esc_html( $option ); ?></option>

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
		'image_id'    => 0,
		'image_size'  => 'medium',
		'class'       => '',
	);
	$args = wp_parse_args( $args, $defaults );

	if ( isset( $args['image_id'] ) && $args['image_id'] ) {

		$output = wp_get_attachment_image( $args['image_id'], $args['image_size'], array( 'class' => $args['class'] ) );

		return $output;
	}

	if ( 'full' === $args['image_size'] ) {
		return 'Please use a defined image size, e.g. "post-thumbnail" or "medium".';
	}

	$image_sizes = alcatraz_get_image_sizes();
	$image_w = $image_sizes[$args['image_size']]['width'];
	$image_h = $image_sizes[$args['image_size']]['height'];

	$img_url = 'https://unsplash.it/' . esc_attr( $image_w ) . '/' . esc_attr( $image_h ) . '/?random';

	$output = sprintf( '<img src="%s" class="%s" >', esc_url( $img_url ), esc_attr( $args['class'] ) );

	return $output;
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
