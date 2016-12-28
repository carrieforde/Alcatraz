<?php
/**
 * Grids
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Grids', 'alcatraz' ); ?></h2>

	<?php alcatraz_pattern_doc( array(
		'heading'      => 'Grid',
		'description'  => 'The Alcatraz Grid with gutters. Use Alcatraz\'s built-in grid classes to create layouts quickly. Grids are built using Bourbon and Neat, and are built on a 12-column system. The 12-column grid can be visualized or adjusted in <code>_grid-settings.scss</code>.',
		'output'       => alcatraz_grid( array( 'gutter' => true ) ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading'      => 'Grid without Gutter',
		'description'  => 'The Alcatraz Grid without gutters. Add the <code>no-gutter</code> class to your column wrapper (row).',
		'output'       => alcatraz_grid( array( 'gutter' => false ) ),
	) ); ?>
</section>
