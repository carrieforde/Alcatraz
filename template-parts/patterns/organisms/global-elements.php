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
		'patterns_included' => 'Primary Navigation',
		'function'          => '',
		'output'            => alcatraz_get_global_element( 'site-header' ),
	) ); ?>
</section>