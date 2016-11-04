<?php
/**
 * Theme fonts.
 */

$fonts = alcatraz_set_theme_fonts();
?>

<section class="section-pattern section-fonts">

	<h2 class="section-heading"><?php esc_html_e( 'Fonts', 'alcatraz' ); ?></h2>

	<?php
	foreach ( $fonts as $key => $value ) { ?>

		<div class="wrap">

			<div class="font-<?php esc_attr_e( $key ); ?>"><?php esc_html_e( $key ); ?>: <?php esc_html_e( $value ); ?></div>

			<div class="font-<?php esc_attr_e( $key ); ?>"><em><?php esc_html_e( $key ); ?>: <?php esc_html_e( $value ); ?></em></div>

			<div class="font-<?php esc_attr_e( $key ); ?>"><strong><?php esc_html_e( $key ); ?>: <?php esc_html_e( $value ); ?></strong></div>

		</div>
	<?php
	} ?>
</section>
