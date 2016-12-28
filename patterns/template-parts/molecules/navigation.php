<?php
/**
 * Navigation
 */
?>

<section class="section-pattern section-navigation">

	<h2 class="section-heading"><?php esc_html_e( 'Navigation', 'alcatraz' ); ?></h2>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Social Menu',
			'description'  => 'Add a social menu in the Dashboard under Appearance > Menus. Create a new menu with links to your social media sites. Save the menu to the Social Menu location. You may show the menu in the footer by ticking the box in the Customizer, or show it any widget area with the Alcatraz Extras plugin.',
			'function'     => 'alcatraz_social_nav()',
			'output'       => alcatraz_social_nav(),
		) ); ?>
	</div>

	<div class="wrap">
		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Post Navigation',
			'description'  => 'This is the native WordPress posts navigation function. See <a href="https://developer.wordpress.org/reference/functions/the_post_navigation/">the CODEX</a> to see how to customize the output.',
			'function'     => 'the_post_navigation()',
			'output'       => get_the_post_navigation(),
		) ); ?>
	</div>
</section>
