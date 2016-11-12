<?php
/**
 * Theme images.
 */
?>

<section class="section-pattern section-images">

	<h2 class="section-heading"><?php esc_html_e( 'Images', 'alcatraz' ); ?></h2>

		<div class="wrap">
			<?php alcatraz_pattern_doc( array(
				'heading'     => 'Post Thumbnail',
				'description' => 'The default post thumbnail is 1200 x 740px',
				'function'    => 'the_post_thumbnail()',
				'output'      => alcatraz_image( array(
					'use_img_url' => true,
					'src' => 'https://unsplash.it/1200/740/?random',
				) ),
			) ); ?>
		</div>

		<div class="wrap">
			<?php alcatraz_pattern_doc( array(
				'heading'     => 'Card Image',
				'description' => 'This is a 300 x 200px image.',
				'function'    => 'alcatraz_image( array( \'use_img_url\' => true ) )',
				'output'      => alcatraz_image( array( 'use_img_url' => true ) ),
			) ); ?>
		</div>
</section>
