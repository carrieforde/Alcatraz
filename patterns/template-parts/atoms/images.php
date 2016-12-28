<?php
/**
 * Theme images.
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Images', 'alcatraz' ); ?></h2>

		<?php alcatraz_pattern_doc( array(
			'heading'     => 'Post Thumbnail',
			'description' => 'The default post thumbnail is 1200 x 740px',
			'function'    => 'the_post_thumbnail()',
			'output'      => alcatraz_image( array(
				'use_img_url' => true,
				'src' => 'https://unsplash.it/1200/740/?random',
			) ),
		) ); ?>

		<?php alcatraz_pattern_doc( array(
			'heading'     => 'Card Image',
			'description' => 'This is a 300 x 200px image.',
			'function'    => 'alcatraz_image( array( \'use_img_url\' => true ) )',
			'output'      => alcatraz_image( array( 'use_img_url' => true ) ),
		) ); ?>
</section>
