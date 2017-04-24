<?php
/**
 * Global Elements
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Global Elements', 'alcatraz' ); ?></h2>

	<?php alcatraz_pattern_doc( array(
		'heading'           => 'Site Header',
		'description'       => '',
		'patterns_included' => 'The <strong>Site Header</strong> pattern contains the <strong>Primary Navigation</strong> pattern.',
		'function'          => '',
		'output'            => alcatraz_get_global_element( 'site-header' ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading'           => 'Site Footer',
		'description'       => '',
		'patterns_included' => 'The <strong>Site Footer</strong> contains the <strong>Footer Bottom</strong>, <strong>Social Navigation</strong> patterns.',
		'output'            => alcatraz_get_global_element( 'site-footer' ),
	) ); ?>
</section>
