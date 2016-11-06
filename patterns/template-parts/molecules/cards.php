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
			'function'     => 'alcatraz_card( array( \'use_img_src\' => true ) )',
			'output'       => alcatraz_card( array( 'use_img_src' => true ) ),
		) ); ?>

	</div>

</section>
