<?php
/**
 * Queries
 *
 * Helper queries that can be used when assembling a pattern library.
 *
 * @package  alcatraz
 */

/**
 * A simple query used to fetch posts with markup from a specified template part.
 *
 * @param   array  [$args = array()]  The arguments.
 *
 * @return  string                    The HTML markup.
 */
function alcatraz_fetch_posts( $args = array() ) {

	$defaults = array(
		'category_name'   => '',
		'post_type'       => 'post',
		'posts_per_page'  => 1,
		'template_part'   => 'template-parts/content',
	);
	$args = wp_parse_args( $args, $defaults );

	$post = array(
		'category_name'   => esc_attr( $args['category_name'] ),
		'post_type'       => esc_attr( $args['post_type'] ),
		'posts_per_page'  => intval( $args['posts_per_page'] ),
	);

	$posts = new WP_Query( $post );

	if ( $posts->have_posts() ) {

		ob_start();

		while ( $posts->have_posts() ) {

			$posts->the_post();

			get_template_part( $args['template_part'] );
		}
	}

	wp_reset_postdata();

	return ob_get_clean();
}

/**
 * Get sticky post(s).
 *
 * @param  array  [$args            = array()] The args.
 *
 * @return string The post markup.
 */
function alcatraz_get_sticky_post( $args = array() ) {

	$defaults = array(
		'posts_per_page'      => 1,
		'post__in'            => get_option( 'sticky_posts' ),
		'ignore_sticky_posts' => 1,
		'template_part'       => 'template-parts/content',
	);
	$args = wp_parse_args( $args, $defaults );

	$post = array(
		'posts_per_page'      => absint( $args['posts_per_page'] ),
		'post__in'            => array_map( 'esc_attr', $args['post__in'] ),
		'ignore_sticky_posts' => absint( $args['ignore_sticky_posts'] ),
	);

	$posts = new WP_Query( $post );

	if ( $posts->have_posts() ) {

		ob_start();

		while ( $posts->have_posts() ) {
			$posts->the_post();

			get_template_part( $args['template_part'] );
		}
	}

	wp_reset_postdata();

	return ob_get_clean();
}


/**
 * Get a random (or specific) post ID or set of post IDs for use within the pattern library.
 *
 * @param   array [$args = array()] The WP_Query arguments.
 *
 * @return  int                     The queried post ID(s).
 */
function alcatraz_get_post_id( $args = array() ) {

	$defaults = array(
		'category_name'   => '',
		'orderby'         => 'rand',
		'post_type'       => 'post',
		'tag'             => '',
	);
	$args = wp_parse_args( $args, $defaults );

	$post = array(
		'category_name'   => esc_attr( $args['category_name'] ),
		'orderby'         => esc_attr( $args['orderby']),
		'post_type'       => esc_attr( $args['post_type'] ),
		'posts_per_page'  => 1,
		'tag'             => esc_attr( $args['tag'] ),
	);

	$posts = new WP_Query( $post );

	$post_id = 0;

	if ( $posts->have_posts() ) {

		while ( $posts->have_posts() ) {

			$posts->the_post();

			$post_id = get_the_ID();
		}
	}

	wp_reset_postdata();

	return $post_id;
}


function alcatraz_get_media_image_id() {

	$post = array(
		'orderby'         => 'rand',
		'post_status'     => 'inherit',
		'post_type'       => 'attachment',
		'post_mime_type'  => 'image',
		'posts_per_page'  => 1,
	);

	$posts = new WP_Query( $post );

	$image_id = 0;

	if ( $posts->have_posts() ) {

		while ( $posts->have_posts() ) {

			$posts->the_post();

			$image_id = get_the_ID();
		}
	}

	wp_reset_postdata();

	return $image_id;
}
