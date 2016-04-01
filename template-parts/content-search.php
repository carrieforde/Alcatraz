<?php
/**
 * Content template for search results.
 *
 * @package alcatraz
 */
?>

<?php do_action( 'alcatraz_before_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php alcatraz_the_entry_title(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<?php alcatraz_the_entry_footer(); ?>
</article>

<?php do_action( 'alcatraz_after_entry' ); ?>