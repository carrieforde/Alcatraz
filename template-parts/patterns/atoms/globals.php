<?php
/**
 * Globals
 */

$fonts = alcatraz_set_theme_fonts();
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Globals', 'alcatraz' ); ?></h2>

	<?php alcatraz_global_pattern( array( 'global_type' => 'colors', 'heading' => 'Colors' ) ); ?>

	<?php alcatraz_global_pattern( array( 'global_type' => 'fonts', 'heading' => 'Fonts' ) ); ?>
</section>
<?php
