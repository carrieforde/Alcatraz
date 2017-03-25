<?php
/**
 * Typography
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Typography', 'alcatraz' ); ?></h2>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Headings',
		'output'  => alcatraz_typography( array( 'element' => 'headings' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Horizontal Rule',
		'output'  => alcatraz_typography( array( 'element' => 'hr' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Inline Elements',
		'output'  => alcatraz_typography( array( 'element' => 'inline' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Paragraph',
		'output'  => alcatraz_typography( array( 'element' => 'paragraph' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Preformatted',
		'output' => alcatraz_typography( array( 'element' => 'preformatted' ) ),
	) ); ?>
</section>
