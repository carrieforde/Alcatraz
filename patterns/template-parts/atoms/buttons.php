<?php
/**
 * Buttons
 */
?>

<section class="alcatraz-pattern">

	<h2 class="alcatraz-pattern__heading"><?php esc_html_e( 'Buttons', 'alcatraz' ); ?></h2>

		<?php alcatraz_pattern_doc( array(
			'heading'     => 'Button',
			'description' => 'This is a <code>button</code>.',
			'function'    => 'alcatraz_button( array( \'type\' => \'button\' ) )',
			'params'      => array( '$args' => 'The function arguments' ),
			'args'        => array( 'type' => 'button' ),
			'output'      => alcatraz_button( array( 'type' => 'button' ) ),
		) ); ?>

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Submit',
			'description'  => 'This is an <code>input[type="submit"]</code>.',
			'function'     => 'alcatraz_button( array( \'type\' => \'submit\' ) )',
			'params'       => array( '$args' => 'The function arguments' ),
			'args'         => array( 'type' => 'submit' ),
			'output'       => alcatraz_button( array( 'type' => 'submit' ) ),
		) ); ?>

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Text',
			'description'  => 'This is an <code>a</code> button.',
			'function'     => 'alcatraz_button( array( \'type\' => \'text\' ) )',
			'params'       => array( '$args' => 'The function arguments' ),
			'args'         => array( 'type' => 'text' ),
			'output'       => alcatraz_button( array( 'type' => 'text' ) ),
		) ); ?>
</section>
