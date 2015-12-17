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

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php alcatraz_posted_on(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alcatraz' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="entry-footer">
		<?php alcatraz_entry_footer(); ?>
	</footer>
</article>

<?php do_action( 'alcatraz_after_entry' ); ?>
