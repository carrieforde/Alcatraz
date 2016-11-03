<?php
/**
 * Buttons
 */
?>

<section class="section-pattern section-buttons">

	<h2 class="section-heading"><?php esc_html_e( 'Buttons', 'alcatraz' ); ?></h2>

	<div class="button-type-wrap">

		<h3 class="section-sub-heading"><?php esc_html_e( 'Button', 'alcatraz' ); ?></h3>

		<?php alcatraz_button( array('type' => 'button' ) ); ?>

	</div>

	<div class="button-type-wrap">

		<h3 class="section-sub-heading"><?php esc_html_e( 'Submit', 'alcatraz' ); ?></h3>

		<?php alcatraz_button( array( 'type' => 'submit' ) ); ?>

	</div>

	<div class="button-type-wrap">

		<h3 class="section-sub-heading"><?php esc_html_e( 'Text', 'alcatraz' ); ?></h3>

		<?php alcatraz_button( array( 'type' => 'text' ) ); ?>

	</div>

</section>
