<?php
/**
 * Template for displaying the Footer.
 *
 * This template contains the closing of the #content div and all content after.
 *
 * @package alcatraz
 */

?>

		<?php do_action( 'alcatraz_after_content_inside' ); ?>

	</div>

	<?php do_action( 'alcatraz_after_content' ); ?>

	<?php do_action( 'alcatraz_before_footer' ); ?>

	<footer id="site-footer" class="site-footer" role="contentinfo">

		<?php do_action( 'alcatraz_footer' ); ?>

	</footer>

	<?php do_action( 'alcatraz_after_footer' ); ?>

</div>

<?php do_action( 'alcatraz_after' ); ?>

<?php wp_footer(); ?>

</body>
</html>