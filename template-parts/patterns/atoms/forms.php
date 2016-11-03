<?php
/**
 * Forms
 */
?>

<section class="section-pattern section-forms">

	<h2 class="section-heading"><?php esc_html_e( 'Forms', 'alcatraz' ); ?></h2>

	<div class="wrap">

		<h3 class="section-sub-heading"><?php esc_html_e( 'Text Field', 'alcatraz' ); ?></h3>

		<?php alcatraz_form_elements( array( 'tag' => 'text' ) ); ?>

	</div>

	<div class="wrap">

		<h3 class="section-sub-heading"><?php esc_html_e( 'Textarea', 'alcatraz' ); ?></h3>

		<?php alcatraz_form_elements( array( 'tag' => 'textarea' ) ); ?>

	</div>

	<div class="wrap">

		<h3 class="section-sub-heading"><?php esc_html_e( 'Select', 'alcatraz' ); ?></h3>

		<?php alcatraz_form_elements( array( 'tag' => 'select' ) ); ?>

	</div>

	<?php
		alcatraz_form_elements( array(
				'type'          => 'email',
				'placeholder'   => 'email@example.com',
				'autocomplete'  => 'on',
			)
		);
	?>

</section>
