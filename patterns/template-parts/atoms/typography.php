<?php
/**
 * Typography
 */
?>

<section class="section-pattern section-typography">

	<h2 class="section-heading"><?php esc_html_e( 'Typography', 'alcatraz' ); ?></h2>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading' => 'Headings',
			'output'  => alcatraz_typography( array( 'element' => 'headings' ) ),
		) ); ?>
	</div>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading' => 'Horizontal Rule',
			'output'  => alcatraz_typography( array( 'element' => 'hr' ) ),
		) ); ?>
	</div>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading' => 'Inline Elements',
			'output'  => alcatraz_typography( array( 'element' => 'inline' ) ),
		) ); ?>
	</div>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading' => 'Paragraph',
			'output'  => alcatraz_typography( array( 'element' => 'paragraph' ) ),
		) ); ?>
	</div>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading' => 'Preformatted',
			'output' => alcatraz_typography( array( 'element' => 'preformatted' ) ),
		) ); ?>
	</div>

</section>
