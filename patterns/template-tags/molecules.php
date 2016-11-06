<?php
/**
 * Pattern Library Molecules.
 *
 * @package alcatraz
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

	<div class="alcatraz-card alcatraz-col-4 <?php esc_attr_e( $args['class'] ); ?>">

		<div class="card-image">
			<?php echo wp_kses_post( alcatraz_image( array( 'src' => $args['src'], 'use_img_src' => true ) ) ); ?>
		</div>

		<header class="card-header">
			<h3 class="card-title"><a href="<?php echo esc_url( $args['link'] ); ?>"><?php esc_html_e( $args['title'] ); ?></a></h3>
		</header>

		<div class="card-content">
			<?php esc_html_e( $args['excerpt'] ); ?>
		</div>

		<footer class="card-footer">
			<?php echo wp_kses_post( alcatraz_button( array( 'type' => 'text', 'link' => $args['link'], 'button_text' => 'Read More' ) ) ); ?>
		</footer>

	</div>

	<?php return ob_get_clean();
}
