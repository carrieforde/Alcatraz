<?php
/**
 * Forms
 */
?>

<section class="section-pattern section-forms">

	<h2 class="section-heading"><?php esc_html_e( 'Forms', 'alcatraz' ); ?></h2>

	<div class="wrap">
		<h3 class="section-sub-heading"><?php esc_html_e( 'Text Input', 'alcatraz' ); ?></h3>
		<?php
		alcatraz_form_elements( array(
			'type'          => 'text',
			'placeholder'   => 'Text Input',
		) );
		?>
	</div>

	<div class="wrap">
		<h3 class="section-sub-heading"><?php esc_html_e( 'Radio', 'alcatraz' ); ?></h3>
		<?php alcatraz_form_elements( array( 'type' => 'radio' ) ); ?>
	</div>

	<div class="wrap">
		<h3 class="section-sub-heading"><?php esc_html_e( 'Checkbox', 'alcatraz' ); ?></h3>
		<?php alcatraz_form_elements( array( 'type' => 'checkbox' ) ); ?>
	</div>

	<div class="wrap">
		<h3 class="section-sub-heading"><?php esc_html_e( 'Textarea', 'alcatraz' ); ?></h3>
		<?php alcatraz_form_elements( array( 'tag' => 'textarea' ) ); ?>
	</div>

	<div class="wrap">
		<h3 class="section-sub-heading"><?php esc_html_e( 'Select', 'alcatraz' ); ?></h3>
		<?php alcatraz_form_elements( array( 'tag' => 'select' ) ); ?>
	</div>

</section>
