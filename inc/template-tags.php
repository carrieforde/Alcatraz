<?php
/**
 * Alcatraz custom template tags.
 *
 * @package alcatraz
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function alcatraz_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'alcatraz' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'alcatraz' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function alcatraz_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		$categories_list = get_the_category_list( esc_html__( ', ', 'alcatraz' ) );
		if ( $categories_list && alcatraz_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'alcatraz' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'alcatraz' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'alcatraz' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'alcatraz' ), esc_html__( '1 Comment', 'alcatraz' ), esc_html__( '% Comments', 'alcatraz' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'alcatraz' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function alcatraz_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'alcatraz_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'alcatraz_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so alcatraz_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so alcatraz_categorized_blog should return false.
		return false;
	}
}

add_action( 'edit_category', 'alcatraz_category_transient_flusher' );
add_action( 'save_post',     'alcatraz_category_transient_flusher' );
/**
 * Flush out the transients used in alcatraz_categorized_blog.
 */
function alcatraz_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'alcatraz_categories' );
}

/**
 * Build the social network icon output.
 *
 * @since 1.0.0
 */
function alcatraz_get_the_social_network_icons() {

	$options = get_option( 'alcatraz_options' );

	ob_start(); ?>

	<div class="alcatraz-social-icon-wrap">
		<ul class="alcatraz-social-icons">
			<?php if ( ! empty( $options['email_url'] ) ) : ?>
				<li class="email">
					<a href="mailto:<?php echo esc_attr( $options['email_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-email" target="_blank">
						<i class="fa fa-envelope"></i>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $options['facebook_url'] ) ) : ?>
				<li class="facebook">
					<a href="<?php echo esc_url( $options['facebook_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-facebook" target="_blank">
						<i class="fa fa-facebook"></i>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $options['twitter_url'] ) ) : ?>
				<li class="twitter">
					<a href="<?php echo esc_url( $options['twitter_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-twitter" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $options['instagram_url'] ) ) : ?>
				<li class="instagram">
					<a href="<?php echo esc_url( $options['instagram_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-instagram" target="_blank">
						<i class="fa fa-instagram"></i>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $options['pinterest_url'] ) ) : ?>
				<li class="pinterest">
					<a href="<?php echo esc_url( $options['pinterest_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-pinterest" target="_blank">
						<i class="fa fa-pinterest"></i>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $options['youtube_url'] ) ) : ?>
				<li class="youtube">
					<a href="<?php echo esc_url( $options['youtube_url'] ) ; ?>" class="alcatraz-social-icon alcatraz-icon-youtube" target="_blank">
						<i class="fa fa-youtube"></i>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<?php

	return ob_get_clean();
}

/**
 * Display the social icon output.
 *
 * @since 1.0.0
 */
function alcatraz_the_social_network_icons() {

	echo alcatraz_get_the_social_network_icons();
}

/**
 * Display the section nav output.
 *
 * @since 1.0.0
 */
function alcatraz_get_subpage_nav() {

	$options = get_option( 'alcatraz_options' );

	global $post;

	$args = array();

	//defaults
	$defaults = alcatraz_get_subpage_nav_options();

	$args = wp_parse_args( $args, $defaults );

	// Get clean param values.
	$show_all     = $args['show_all'];
	$show_on_home = $args['show_on_home'];
	$show_empty   = $args['show_empty'];
	$exclude_list = $args['exclude_list'];
	$sort_by      = $args['sort_by'];
	$title        = $args['title'];

	if ( is_search() || is_404() ) {
		return false; //doesn't apply to search or 404 page
	}

	if ( is_front_page() ) {
		return false;	//if we're on the front page and we haven't chosen to show this anyways, leave
	}

	if ( ! $post->post_parent ) {
		$children = wp_list_pages( array(
			'title_li'    => '',
			'depth'       => 1,
			'sort_column' => $sort_by,
			'child_of'    => $post->ID,
			'echo'        => false,
			));
		}

	if ( is_page() ) {

		if ( isset( $post) && is_object( $post ) ) {
		get_post_ancestors($post);
   		//workaround for occassional problems
		} else {

			if ( $post_page = get_option("page_for_posts") ) {

		 		$post = get_page($post_page);
			}
		 //treat the posts page as the current page if applicable
		else return false;

		}

		if ( is_front_page() || isset( $sub_front_page ) ) {

			echo "<ul>";

			$children = wp_list_pages(array(
				'title_li'    => '',
				'depth'       => 1,
				'sort_column' => $sort_by,
				'echo'        => false
				));

			echo $children;
			echo "</ul>";
			return true;
	  	}

		$post_ancestors = ( isset($post->ancestors) ) ? $post->ancestors : get_post_ancestors($post); //get the current page's ancestors either from existing value or by executing function
		$top_page = $post_ancestors ? end($post_ancestors) : $post->ID; //get the top page id

		$thedepth = 0; //initialize default variables

		$excluded = explode(',', $exclude_list); //convert list of excluded pages to array

		if ( in_array( $post->ID,$excluded ) ) {
			return false; //if on excluded page, and setup to hide on excluded pages
		}

		$post_ancestors = ( isset($post->ancestors) ) ? $post->ancestors : get_post_ancestors($post); //get the current page's ancestors either from existing value or by executing function
		$top_page = $post_ancestors ? end($post_ancestors) : $post->ID; //get the top page id

		$children = wp_list_pages(array(
			'title_li'    => '',
			'echo'        => 0,
			'depth'       => $thedepth,
			'child_of'    => $top_page,
			'sort_column' => $sort_by
		 	));	//get the list of pages, including only those in our page list

		if( ! $children && ! $show_empty) {
			return false; 	//if there are no pages in this section, and user hasnt chosen to display widget anyways, leave the function
		}

		printf( '<aside id="%s" class="%s"><div id="%s" class="%s" role="complementary"><ul class="%s">%s</ul></aside>',
			'alcatraz_sidebar_nav',
			'sidebar-nav',
			'secondary',
			'primary-sidebar sidebar',
			'sidebar-nav-top-level',
			$children
		);
	}

}

/**
 * Display the section nav output.
 *
 * @since 1.0.0
 */
function alcatraz_the_subpage_nav() {

	echo alcatraz_get_subpage_nav();
}