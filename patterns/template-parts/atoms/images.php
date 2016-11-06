<?php
/**
 * Theme images.
 */
?>

<section class="section-pattern section-images">

	<h2 class="section-heading"><?php esc_html_e( 'Images', 'alcatraz' ); ?></h2>

		<div class="wrap">
			<?php alcatraz_pattern_doc( array(
				'heading' => 'Card Image',
				'description' => 'This is a 300 x 200px image.',
				'function' => 'alcatraz_image( array( \'use_img_url\' => true ) )',
				'output' => alcatraz_image( array( 'use_img_url' => true ) ),
			) ); ?>
		</div>
</section>
