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

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php do_action( 'alcatraz_before_footer_inside' ); ?>

		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'alcatraz' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'alcatraz' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'alcatraz' ), 'alcatraz', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div>

		<?php do_action( 'alcatraz_after_footer_inside' ); ?>

	</footer>

	<?php do_action( 'alcatraz_after_footer' ); ?>

</div>

<?php do_action( 'alcatraz_after' ); ?>

<?php wp_footer(); ?>

</body>
</html>