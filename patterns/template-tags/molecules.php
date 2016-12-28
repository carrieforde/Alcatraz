<?php
/**
 * Pattern Library Molecules.
 *
 * @package alcatraz
 */

/**
 * Form element with Label
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
		<div class="alcatraz-col-<?php echo esc_attr( $col_1 ); ?>"><?php echo esc_html( $col_1 ); ?></div>
		<div class="alcatraz-col-<?php echo esc_attr( $col_2 ); ?>"><?php echo esc_html( $col_2 ); ?></div>
	</div>

	<?php endfor; ?>

	<div class="<?php echo esc_attr( $classes ); ?>">
		<div class="alcatraz-col-12"><?php echo esc_html( '12', 'alcatraz' ); ?></div>
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
		'src'         => 'https://unsplash.it/300/200/?random',
		'use_img_src' => true,
		'title'     => 'Lorem ipsum dolor',
		'excerpt'     => 'Vel ad enim nostrum, eam te odio ubique corpora. Ne eum tota tation ancillae, reque altera mea te. Integre commune indoctum his ea.',
		'link'        => '#',
		'class'       => '',
	);
	$args = wp_parse_args( $args, $defaults );

	ob_start(); ?>

	<div class="alcatraz-card alcatraz-col-4 <?php echo esc_attr( $args['class'] ); ?>">

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
 * Alcatraz Social Navigation
 *
 * @return  string  The HTML.
 */
function alcatraz_social_nav() {

	ob_start(); ?>

	<nav id="social-nav" class="social-nav" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'alcatraz' ); ?>">

		<?php wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class' => 'social-nav__menu',
			'depth' => 1,
			'link_before' => '<span class="screen-reader-text">',
			'link_after'  => '</span>',
		) ); ?>
	</nav>

	<?php return ob_get_clean();
}
