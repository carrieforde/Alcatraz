<?php
/**
 * Cards
 */
?>

<section class="section-pattern section-cards">

	<h2 class="section-heading"><?php esc_html_e( 'Cards', 'alcatraz' ); ?></h2>

	<div class="wrap">

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Card',
			'description'  => 'This is a card. It utilizes <code>alcatraz_image()</code> and <code>alcatraz_button</code>.',
			'function'     => 'alcatraz_card( array( \'use_img_src\' => true ) );',
			'output'       => '<div class="alcatraz-card alcatraz-col-4 ">

	<div class="card-image">
		<img src="https://unsplash.it/300/200/?random" />
	</div>

	<header class="card-header">
		<h3 class="card-title"><a href="#">Lorem ipsum dolor</a></h3>
	</header>

	<div class="card-content">
		Vel ad enim nostrum, eam te odio ubique corpora. Ne eum tota tation ancillae, reque altera mea te. Integre commune indoctum his ea.
	</div>

	<footer class="card-footer">
		<a href="" class="button button-text" target="">Submit</a>
	</footer>

</div>',
		) ); ?>

		<?php alcatraz_card( array( 'use_img_src' => true ) ); ?>

	</div>

</section>
