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

				<?php do_action( 'alcatraz_before_patterns' ); ?>

				<?php get_template_part( 'template-parts/patterns/molecules/cards' ); ?>

				<?php get_template_part( 'template-parts/patterns/molecules/forms' ); ?>

				<?php get_template_part( 'template-parts/patterns/molecules/grid' ); ?>

				<?php get_template_part( 'template-parts/patterns/molecules/media' ); ?>

				<?php get_template_part( 'template-parts/patterns/molecules/navigation' ); ?>

				<?php get_template_part( 'template-parts/patterns/molecules/typography' ); ?>

				<?php do_action( 'alcatraz_after_patterns' ); ?>

				<?php the_post_navigation(); ?>

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

<?php get_footer(); ?>
