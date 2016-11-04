<?php
/**
 * Buttons
 */
?>

<section class="section-pattern section-buttons">

	<h2 class="section-heading"><?php esc_html_e( 'Buttons', 'alcatraz' ); ?></h2>

	<div class="wrap">

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Button',
			'description'  => 'This is a <code>button</code>.',
			'function'     => 'alcatraz_button( array( \'type\' => \'button\' ) );',
			'output'       => '<button class="button">Submit</button>',
		) ); ?>

		<?php alcatraz_button( array( 'type' => 'button' ) ); ?>

	</div>

	<div class="wrap">

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Submit',
			'description'  => 'This is an <code>input[type="submit"]</code>.',
			'function'     => 'alcatraz_button( array( \'type\' => \'submit\' ) );',
			'output'       => '<input type="submit" value="Submit" class="button button-submit" />',
		) ); ?>

		<?php alcatraz_button( array( 'type' => 'submit' ) ); ?>

	</div>

	<div class="wrap">

		<?php alcatraz_pattern_doc( array(
			'heading'      => 'Text',
			'description'  => 'This is an <code>a</code> button.',
			'function'     => 'alcatraz_button( array( \'type\' => \'text\' ) );',
			'output'       => '<a href="" class="button button-text" target="">Submit</a>',
		) ); ?>

		<?php alcatraz_button( array( 'type' => 'text' ) ); ?>

	</div>

</section>
