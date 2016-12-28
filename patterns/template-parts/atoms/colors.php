<?php
/**
 * Theme colors.
 */

$colors = alcatraz_set_theme_colors();
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Colors', 'alcatraz' ); ?></h2>

	<?php foreach ( $colors as $group => $colors ) : ?>

		<div class="wrap">

			<h3 class="pattern-doc-heading"><?php esc_html_e( $group ); ?></h3>

			<div class="pattern-doc-colors">
			<?php foreach ( $colors as $key => $value ) : ?>

				<div class="color-chip">

					<div class="color" style="background: <?php esc_attr_e( $value ); ?>"></div>
					<span class="color-name">$<?php esc_html_e( $key ); ?> : <?php esc_html_e( $value ); ?></span>

				</div>

			<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
</section>
