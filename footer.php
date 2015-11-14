<?php
/**
 * Template for displaying the Footer.
 *
 * This template contains the closing of the #content div and all content after.
 *
 * @package alcatraz
 */

?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'alcatraz' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'alcatraz' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'alcatraz' ), 'alcatraz', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
