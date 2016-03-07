<?php
/**
 * Default template for singlular pages for all post types except page.
 *
 * @package alcatraz
 */
?>

<?php do_action( 'alcatraz_before_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<?php alcatraz_the_entry_header(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alcatraz' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<?php alcatraz_the_entry_footer(); ?>
</article>

<?php do_action( 'alcatraz_after_entry' ); ?>
