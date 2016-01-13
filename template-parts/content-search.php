<?php
/**
 * Content template for search results.
 *
 * @package alcatraz
 */
?>

<?php do_action( 'alcatraz_before_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">	

		alcatraz_entry_header();

		alcatraz_entry_title();

		<?php if ( 'post' === get_post_type() ) : ?>
		alcatraz_entry_meta();
		<?php endif; ?>

	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<?php alcatraz_entry_footer(); ?>
	</footer>
</article>

<?php do_action( 'alcatraz_after_entry' ); ?>