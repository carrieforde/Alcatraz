<?php
/**
 * Theme fonts.
 */

$fonts = alcatraz_set_theme_fonts();
?>

<section class="section-pattern section-fonts">

	<h2 class="section-heading"><?php esc_html_e( 'Fonts', 'alcatraz' ); ?></h2>

	<div class="wrap">
	<?php foreach ( $fonts as $key => $value ) { ?>

			<div style="font-family: <?php esc_attr_e( $value ); ?>">$<?php esc_html_e( $key ); ?>: <?php esc_html_e( $value ); ?></div>

			<div style="font-family: <?php esc_attr_e( $value ); ?>"><em>$<?php esc_html_e( $key ); ?>: <?php esc_html_e( $value ); ?></em></div>

			<div style="font-family: <?php esc_attr_e( $value ); ?>"><strong>$<?php esc_html_e( $key ); ?>: <?php esc_html_e( $value ); ?></strong></div>

	<?php } ?>
	</div>
</section>
<?php
