<?php
/**
 * Typography
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Typography', 'alcatraz' ); ?></h2>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Unordered List',
		'output'  => alcatraz_lists( array( 'type' => 'unordered' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Ordered List',
		'output'  => alcatraz_lists( array( 'type' => 'ordered' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Mixed List',
		'output'  => alcatraz_lists( array( 'type' => 'mixed' ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Blockquote',
		'output'  => alcatraz_blockquote( array() ),
	) ); ?>
</section>
