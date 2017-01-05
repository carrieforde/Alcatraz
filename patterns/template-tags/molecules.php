<?php
/**
 * Pattern Library Molecules.
 *
 * @package alcatraz
 */

/**
 * Form Element with Label
 *
 * @param   array   The args.
 * @return  string  The HTML.
 */
function alcatraz_form_element_with_label( $args = array() ) {

	$defaults = array(
		'label_text'   => '',
		'label_class'  => '',
		'tag'          => 'input',
		'type'         => '',
		'name'         => '',
		'value'        => '',
		'placeholder'  => '',
		'required'     => '',
		'autocomplete' => false,
		'class'        => '',
	);
	$args = wp_parse_args( $args, $defaults );

	// Grab our allowed HTML tags.
	$allowed_tags = alcatraz_pattern_allowed_html();

	ob_start(); ?>

	<label for="<?php echo esc_attr( $args['name'] ); ?>" class="<?php echo esc_attr( $args['label_class'] ); ?>"><?php echo esc_html( $args['label_text'] ); ?></label>
	<?php echo wp_kses( alcatraz_form_elements( array(
		'tag'           => $args['tag'],
		'type'          => $args['type'],
		'name'          => $args['name'],
		'value'         => $args['value'],
		'placeholder'   => $args['placeholder'],
		'required'      => $args['required'],
		'autocomplete'  => $args['autocomplete'],
		'class'         => $args['class'],
	) ), $allowed_tags ); ?>

	<?php return ob_get_clean();
}

/**
 * The Alcatraz Grid
 *
 * @param   array   The arguments.
 * @return  string  The grid HTML.
 */
function alcatraz_grid( $args = array() ) {

	$defaults = array(
		'gutter' => true,
	);
	$args = wp_parse_args( $args, $defaults );

	// Build our classes string.
	$classes = 'row';
	if ( ! $args['gutter'] ) {
		$classes .= ' no-gutter';
	}

	ob_start();

	for ( $i = 1; $i < 12; $i++ ) :

		$col_1 = $i;
		$col_2 = 12 - $i; ?>

	<div class="<?php echo esc_attr( $classes ); ?>">
		<div class="alcatraz-col--<?php echo esc_attr( $col_1 ); ?>"><?php echo esc_html( $col_1 ); ?></div>
		<div class="alcatraz-col--<?php echo esc_attr( $col_2 ); ?>"><?php echo esc_html( $col_2 ); ?></div>
	</div>

	<?php endfor; ?>

	<div class="<?php echo esc_attr( $classes ); ?>">
		<div class="alcatraz-col--12"><?php echo esc_html( '12', 'alcatraz' ); ?></div>
	</div>

	<?php return ob_get_clean();
}

/**
 * Cards
 *
 * @param   array   The arguments.
 * @return  string  The HTML.
 */
function alcatraz_card( $args = array() ) {

	$defaults = array(
		'type'    => 'url',
		'src'     => 'https://unsplash.it/1200/740/?random',
		'title'   => 'Lorem ipsum dolor',
		'excerpt' => 'Vel ad enim nostrum, eam te odio ubique corpora. Ne eum tota tation ancillae, reque altera mea te. Integre commune indoctum his ea.',
		'link'    => '#',
		'class'   => '',
	);
	$args = wp_parse_args( $args, $defaults );

	ob_start(); ?>

	<div class="alcatraz-card <?php echo ( ! empty( $args['class'] ) ) ? esc_attr( $args['class'] ) : ''; ?>">

		<div class="alcatraz-card__image">
			<?php echo wp_kses_post( alcatraz_image( array( 'src' => $args['src'], 'use_img_src' => true ) ) ); ?>
		</div>

		<header class="alcatraz-card__header">
			<h3 class="alcatraz-card__title"><a href="<?php echo esc_url( $args['link'] ); ?>"><?php echo esc_html( $args['title'] ); ?></a></h3>
		</header>

		<div class="alcatraz-card__content">
			<?php echo esc_html( $args['excerpt'] ); ?>
		</div>

		<footer class="alcatraz-card__footer">
			<?php echo wp_kses_post( alcatraz_button( array( 'type' => 'text', 'link' => $args['link'], 'button_text' => 'Read More' ) ) ); ?>
		</footer>

	</div>

	<?php return ob_get_clean();
}

/**
 * Alcatraz Lists
 *
 * @param  array  The args.
 */
function alcatraz_lists( $args = array() ) {

	$defaults = array(
		'type' => 'unordered',
	);
	$args = wp_parse_args( $args, $defaults );

	ob_start();

	switch ( $args['type'] ) :

		case 'unordered' : ?>

			<ul>
				<li>unordered item</li>
				<li>unordered item
					<ul>
						<li>unordered item</li>
						<li>unordered item
							<ul>
								<li>unordered item</li>
								<li>unordered item</li>
							</ul>
						</li>
					</ul>
				</li>
				<li>unordered item</li>
				<li>unordered item</li>
			</ul>

			<?php break;

		case 'ordered' : ?>

			<ol>
				<li>ordered item</li>
				<li>ordered item
					<ol>
						<li>ordered item</li>
						<li>ordered item
							<ol>
								<li>ordered item</li>
								<li>ordered item</li>
							</ol>
						</li>
					</ol>
				</li>
				<li>ordered item</li>
				<li>ordered item</li>
			</ol>

			<?php break;

		case 'mixed' : ?>

			<ol>
				<li>ordered item</li>
				<li>ordered item
					<ul>
						<li>ordered item</li>
						<li>ordered item
							<ol>
								<li>ordered item</li>
								<li>ordered item</li>
							</ol>
						</li>
					</ul>
				</li>
				<li>ordered item</li>
				<li>ordered item</li>
			</ol>

			<?php break;

	endswitch;

	return ob_get_clean();
}

/**
 * Build and return a blockquote.
 *
 * @params  array   The args.
 * @return  string  The HTML.
 */
function alcatraz_blockquote( $args = array() ) {

	$defaults = array(
		'quote' => 'I am an optimist, and I believe that people are inherently good and that if you give everyone a voice and freedom of expression, the truth and the good will outweigh the bad.',
		'cite'  => 'Matt Mullenweg',
		'class' => '',
	);
	$args = wp_parse_args( $args, $defaults );

	ob_start(); ?>

	<blockquote <?php echo ( ! empty( $args['class'] ) ) ? 'class="' . esc_attr( $args['class'] ) . '"' : ''; ?>>
		<?php echo esc_html( $args['quote'] ); ?>
		<?php if ( ! empty( $args['cite'] ) ) : ?>
			<cite><?php echo esc_html( $args['cite'] ); ?></cite>
		<?php endif; ?>
	</blockquote>

	<?php return ob_get_clean();
}

/**
 * Build and return an image with caption.
 *
 * @param   array   The args.
 * @return  string  The HTML.
 */
function alcatraz_image_with_caption( $args = array() ) {

	$defaults = array(
		'type'    => 'url',
		'src'     => 'https://unsplash.it/600/370/?random',
		'size'    => '',
		'class'   => '',
		'caption' => 'It is a thing of absolute, stunning beauty.',
	);
	$args = wp_parse_args( $args, $defaults );

	ob_start(); ?>

	<figure <?php echo ( ! empty( $args['class'] ) ) ? 'class="' . esc_attr( $args['class'] ) . '"' : ''; ?>>
		<?php echo wp_kses_post( alcatraz_image( array( 'type' => $args['type'], 'src' => $args['src'], 'size' => $args['size'] ) ) ); ?>
		<?php if ( ! empty( $args['caption'] ) ) : ?>
		<figcaption class="wp-caption"><?php echo wp_kses_post( $args['caption'] ); ?></figcaption>
		<?php endif; ?>
	</figure>

	<?php return ob_get_clean();
}
