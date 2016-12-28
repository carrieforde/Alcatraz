<?php
/**
 * Cards
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Cards', 'alcatraz' ); ?></h2>

	<?php alcatraz_pattern_doc( array(
		'heading'      => 'Card',
		'description'  => 'This is a card. It utilizes <code>alcatraz_image()</code> and <code>alcatraz_button</code>.',
		'function'     => "alcatraz_card( array( 'class' => 'alcatraz-col--4' ) )",
		'output'       => alcatraz_card( array( 'class' => 'alcatraz-col--4' ) ),
	) ); ?>
</section>
