<?php
/**
 * Typography
 */
?>

<section class="section-pattern section-buttons">

	<h2 class="section-heading"><?php esc_html_e( 'Typography', 'alcatraz' ); ?></h2>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Headings',
			'output'       => '<header>
	<h1>Heading 1</h1>
	<h2>Heading 2</h2>
	<h3>Heading 3</h3>
	<h4>Heading 4</h4>
	<h5>Heading 5</h5>
	<h6>Heading 6</h6>
</header>',
		) ); ?>

		<?php alcatraz_typography( array( 'element' => 'headings' ) ); ?>
	</div>

</section>
