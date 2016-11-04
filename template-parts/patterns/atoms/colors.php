<?php
/**
 * Theme colors.
 */

$colors = alcatraz_set_theme_colors();
?>

<section class="section-pattern section-colors">

	<h2 class="section-heading"><?php esc_html_e( 'Colors', 'alcatraz' ); ?></h2>

	<?php
	foreach ( $colors as $key => $value ) { ?>

		<div class="color-chip">

			<div class="color <?php esc_attr_e( $key ); ?>-background"></div>
			<span class="color-name">$<?php esc_html_e( $key ); ?> : <?php esc_html_e( $value ); ?></span>

		</div>
	<?php
	} ?>
</section>
