<?php
/**
 * Template Name: Patterns - Molecules
 * Template Post Type: alcatraz_patterns, patterns
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'alcatraz_before_main' ); ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'alcatraz_before_main_inside' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'patterns/template-parts/molecules/cards' ); ?>

				<?php
				// Maybe load comments.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			<?php endwhile; ?>

			<?php do_action( 'alcatraz_after_main_inside' ); ?>

		</main>

		<?php do_action( 'alcatraz_after_main' ); ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
