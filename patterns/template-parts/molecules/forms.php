<?php
/**
 * Forms
 */
?>

<section class="section-pattern section-forms">

	<h2 class="section-heading"><?php esc_html_e( 'Forms', 'alcatraz' ); ?></h2>

	<div class="wrap">

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Search Form',
			'description'  => 'This is the native WordPress search form. You may edit it\'s HTML by creating a <a href="https://developer.wordpress.org/reference/functions/get_search_form/">searchform.php</a> file.',
			'function'     => 'get_search_form()',
			'output'       => get_search_form( $echo = false ),
		) ); ?>

	</div>

</section>
