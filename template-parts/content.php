<?php
/**
 * Default content template.
 *
 * @package alcatraz
 */
?>

<?php do_action( 'alcatraz_before_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail(); ?></a>
	<?php endif; ?>

	<?php alcatraz_the_entry_header(); ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&raquo;</span>', 'alcatraz' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

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
