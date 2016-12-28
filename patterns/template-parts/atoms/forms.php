<?php
/**
 * Forms
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Forms', 'alcatraz' ); ?></h2>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Text Input',
		'description' => 'This is a <code>input[type="text"]</code>.',
		'function' => 'alcatraz_form_elements( array( \'type\' => \'text\', \'placeholder\' => \'Text Input\' ) )',
		'output' => alcatraz_form_elements( array(
			'type'          => 'text',
			'placeholder'   => 'Text Input',
		) ),
		'params' => array( 'args' => 'The function arguments' ),
		'args' => array( 'type' => 'text', 'placeholder' => 'Text' ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Radio',
		'description' => 'This is a <code>input[type="radio"]</code>.',
		'function' => 'alcatraz_form_elements( array( \'type\' => \'radio\' ) )',
		'output' => alcatraz_form_elements( array( 'type' => 'radio' ) ),
		'params' => array( 'args' => 'The function arguments' ),
		'args' => array( 'type' => 'radio' ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Checkbox',
		'description' => 'This is a <code>input[type="checkbox"]</code>.',
		'function' => 'alcatraz_form_elements( array( \'type\' => \'checkbox\' ) )',
		'output' => alcatraz_form_elements( array( 'type' => 'checkbox' ) ),
		'params' => array( 'args' => 'The function arguments' ),
		'args' => array( 'type' => 'checkbox' ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Textarea',
		'description' => 'This is a <code>textarea</code>.',
		'function' => 'alcatraz_form_elements( array( \'tag\' => \'textarea\' ) )',
		'output' => alcatraz_form_elements( array( 'tag' => 'textarea' ) ),
		'params' => array( 'args' => 'The function arguments' ),
		'args' => array( 'tag' => 'textarea' ),
	) ); ?>

	<?php alcatraz_pattern_doc( array(
		'heading' => 'Select',
		'description' => 'This is a <code>select</code>.',
		'function' => 'alcatraz_form_elements( array( \'tag\' => \'select\' ) )',
		'output' => alcatraz_form_elements( array( 'tag' => 'select' ) ),
		'params' => array( 'args' => 'The function arguments' ),
		'args' => array( 'tag' => 'select' ),
	) ); ?>
</section>
