<?php
/**
 * Alcatraz custom template tags.
 *
 * @package alcatraz
 */

/**
 * Build and return the "Posted on ..." HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 *
 * @return  string         The "Posted on ..." HTML.
 */
function alcatraz_posted_on( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U', $post_id ) !== get_post_modified_time( 'U', false, $post_id ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c', $post_id ) ),
		esc_html( get_the_date( '', $post_id ) ),
		esc_attr( get_post_modified_time( 'c', false, $post_id ) ),
		esc_html( get_post_modified_time( '', false, $post_id ) )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'alcatraz' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$author_id = get_post_field( 'post_author', $post_id );

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'alcatraz' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'nicename', $author_id ) ) . '</a></span>'
	);

	$output = '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	return apply_filters( 'alcatraz_posted_on', $output, $post_id, $author_id );
}

/**
 * Echo the "Posted on ..." HTML.
 *
 * @param  int  $post_id  The post ID to use (optional).
 */
function alcatraz_the_posted_on( $post_id = 0 ) {

	echo alcatraz_posted_on( $post_id );
}

/**
 * Build the return edit post link HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 *
 * @return  string         The edit post link HTML.
 */
function alcatraz_edit_post_link( $post_id = 0 ) {

	if ( ! is_user_logged_in() || ! current_user_can( 'edit_post', $post_id ) ) {
		return '';
	}

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$link_text = sprintf(
		'%s %s',
		esc_html__( 'Edit', 'alcatraz' ),
		get_post_type( $post_id )
	);

	$edit_post_link = sprintf(
		'<span class="post-edit-link"><a href="%s">%s</a></span>',
		esc_url( get_edit_post_link( $post_id ) ),
		$link_text
	);

	return apply_filters( 'alcatraz_edit_post_link', $edit_post_link, $post_id );
}

/**
 * Echo the return edit post link HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 */
function alcatraz_the_edit_post_link( $post_id = 0 ) {
	echo alcatraz_edit_post_link( $post_id );
}

/**
 * Build and return the entry header HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 *
 * @return  string         The entry header HTML.
 */
function alcatraz_entry_header( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$header = sprintf(
		'<header class="entry-header">%s%s</header>',
		alcatraz_entry_title( $post_id ),
		alcatraz_entry_meta( $post_id )
	);

	return apply_filters( 'alcatraz_entry_header', $header, $post_id );
}

/**
 * Echo the entry header HTML.
 *
 * @since  1.0.0
 *
 * @param  int  $post_id  The post ID to use (optional).
 */
function alcatraz_the_entry_header( $post_id = 0 ) {

	echo alcatraz_entry_header( $post_id );
}

/**
 * Build and return the entry title HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 *
 * @return  string         The entry title HTML.
 */
function alcatraz_entry_title( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$hide_title = get_post_meta( $post_id, '_alcatraz_hide_title', true );
	$title      = '';

	if ( is_singular() ) {

		if ( 'on' !== $hide_title ) {
			$title = '<h1 class="entry-title">' . get_the_title( $post_id ) . '</h1>';
		}

	} else {

		$title = sprintf(
			'<h2 class="entry-title"><a href="%s" rel="bookmark">%s</a></h2>',
			esc_url( get_permalink( $post_id ) ),
			get_the_title( $post_id )
		);
	}

	return apply_filters( 'alcatraz_entry_title', $title, $post_id );
}

/**
 * Echo the entry title HTML.
 *
 * @since  1.0.0
 *
 * @param  int  $post_id  The post ID to use (optional).
 */
function alcatraz_the_entry_title( $post_id = 0 ) {

	echo alcatraz_entry_title( $post_id );
}

/**
 * Build and return the entry meta HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 *
 * @return  string         The entry meta HTML.
 */
function alcatraz_entry_meta( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$meta       = '';
	$this_type  = get_post_type( $post_id );
	$post_types = apply_filters( 'alcatraz_entry_meta_post_types', array( 'post' ), $post_id );

	foreach ( $post_types as $post_type ) {
		if ( $this_type === $post_type ) {
			$meta = sprintf( '<div class="entry-meta">%s</div>',
				alcatraz_posted_on( $post_id )
			);
			break;
		}
	}

	return apply_filters( 'alcatraz_entry_meta', $meta, $post_id );
}

/**
 * Echo the entry meta HTML.
 *
 * @since  1.0.0
 *
 * @param  int  $post_id  The post ID to use (optional).
 */
function alcatraz_the_entry_meta( $post_id = 0 ) {

	echo alcatraz_entry_meta( $post_id );
}

/**
 * Build and return the entry footer HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 *
 * @return  string         The entry footer HTML.
 */
function alcatraz_entry_footer( $post_id = 0 ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$this_type    = get_post_type( $post_id );
	$post_types   = apply_filters( 'alcatraz_entry_footer_post_types', array( 'post' ), $post_id );
	$entry_footer = '';

	// Only if the entry footer is enabled for the post type.
	if ( in_array( $this_type, $post_types ) ) {

		$entry_footer = '<footer class="entry-footer">';

		// TODO: This block doesn't yet support being used outside of the loop because
		// comments_popup_link doesn't accept a post_id. Ideally we can find a better
		// method for generating the output we want here.
		if ( is_single() && ! post_password_required( $post_id ) && ( comments_open( $post_id ) || get_comments_number( $post_id ) ) ) {
			ob_start();

			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'alcatraz' ), esc_html__( '1 Comment', 'alcatraz' ), esc_html__( '% Comments', 'alcatraz' ) );
			echo '</span>';

			$entry_footer .= ob_get_clean();
		}

		$entry_footer .= alcatraz_edit_post_link( $post_id );

		$entry_footer .= '<hr>';

		// TODO: Ideally we would get the taxonomies that the current post has and loop over
		// them, so that we could support more than categories and tags. We could introduce
		// an alcatraz_entry_footer_taxonomies filter to control which taxonomies show, and
		// default this to array( 'category', 'post_tag' ) to preserve the current behavior.
		$categories_list = get_the_category_list( esc_html__( ', ', 'alcatraz' ), '', $post_id );
		if ( $categories_list && alcatraz_categorized_blog() ) {
			$entry_footer .= sprintf(
				'<span class="cat-links">' . esc_html__( 'Posted in: %1$s', 'alcatraz' ) . '</span>',
				$categories_list
			); // WPCS: XSS OK.
		}

		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'alcatraz' ), '', $post_id );
		if ( $tags_list ) {
			$entry_footer .= sprintf(
				'<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'alcatraz' ) . '</span>',
				$tags_list
			); // WPCS: XSS OK.
		}

		$entry_footer .= '</footer>';
	} else {
		$entry_footer .= alcatraz_edit_post_link( $post_id );
	}

	return apply_filters( 'alcatraz_entry_footer', $entry_footer, $post_id );
}

/**
 * Echo the entry footer HTML.
 *
 * @since   1.0.0
 *
 * @param   int  $post_id  The post ID to use (optional).
 */
function alcatraz_the_entry_footer( $post_id = 0 ) {
	echo alcatraz_entry_footer( $post_id );
}

/**
 * Return true if a blog has more than 1 category.
 *
 * @since   1.0.0
 *
 * @return  bool
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
 *
 * @since  1.0.0
 */
function alcatraz_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'alcatraz_categories' );
}

/**
 * Return an array of the social network data.
 *
 * @since   1.0.0
 *
 * @return  array
 */
function alcatraz_get_social_networks( $context = '' ) {

	$networks = array(
		'email' => array(
			'display_name' => __( 'Email', 'alcatraz' ),
			'description'  => __( 'Enter your email address', 'alcatraz' ),
			'icon'         => 'envelope',
		),
		'facebook' => array(
			'display_name' => __( 'Facebook', 'alcatraz' ),
			'description'  => __( 'Enter your Facebook url', 'alcatraz' ),
			'icon'         => 'facebook',
		),
		'twitter' => array(
			'display_name' => __( 'Twitter', 'alcatraz' ),
			'description'  => __( 'Enter your Twitter url', 'alcatraz' ),
			'icon'         => 'twitter',
		),
		'instagram' => array(
			'display_name' => __( 'Instagram', 'alcatraz' ),
			'description'  => __( 'Enter your Instagram url', 'alcatraz' ),
			'icon'         => 'instagram',
		),
		'pinterest' => array(
			'display_name' => __( 'Pinterest', 'alcatraz' ),
			'description'  => __( 'Enter your Pinterest url', 'alcatraz' ),
			'icon'         => 'twitter',
		),
		'youtube' => array(
			'display_name' => __( 'Youtube', 'alcatraz' ),
			'description'  => __( 'Enter your Youtube url', 'alcatraz' ),
			'icon'         => 'youtube',
		),
	);

	return apply_filters( 'alcatraz_social_networks', $networks, $context );
}

/**
 * Build and return the social network icon HTML.
 *
 * @since   1.0.0
 *
 * @return  string  The social icon HTML.
 */
function alcatraz_get_the_social_network_icons() {

	$options  = get_option( 'alcatraz_options' );
	$networks = alcatraz_get_social_networks();

	ob_start(); ?>

	<div class="alcatraz-social-icon-wrap">
		<ul class="alcatraz-social-icons">
			<?php foreach ( $networks as $network => $network_data ) {
				if ( ! empty( $options[ $network . '_url' ] ) ) {
					 echo alcatraz_get_social_network_icon_html( $network, $options[ $network . '_url' ], $network_data );
				}
			} ?>
		</ul>
	</div>

	<?php

	return apply_filters( 'alcatraz_social_network_icons', ob_get_clean(), $options, $networks );
}

/**
 * Build and return the HTML for a single social icon.
 *
 * @since   1.0.0
 *
 * @param   string  $network       The network name.
 * @param   string  $url           The network URL.
 * @param   array   $network_data  The array of network data.
 *
 * @return  string                 The HTML for the social icon.
 */
function alcatraz_get_social_network_icon_html( $network, $url, $network_data = array() ) {

	// Bail if we don't have a network.
	if ( empty( $network ) ) {
		return;
	}

	// Use mailto: links for any network URLs that are email addresses.
	if ( is_email( $url ) ) {
		$url = 'mailto:' . $url;
	}

	// Use an icon if it is there, otherwise output the network name.
	if ( isset( $network_data['icon'] ) ) {
		$icon_classes = apply_filters( 'alcatraz_social_icon_classes', 'fa fa-' . $network_data['icon'], $network, $url, $network_data );
		$icon = '<i class="' . esc_attr( $icon_classes ) . '" /></i>';
	} else {
		$icon = esc_html( $network );
	}

	$icon_html = sprintf(
		'<li class="%s"><a href="%s" class="%s" target="_blank">%s</a></li>',
		esc_attr( $network ),
		esc_url( $url ),
		'alcatraz-social-icon alcatraz-icon-' . esc_attr( $network ),
		$icon
	);

	return apply_filters( 'alcatraz_social_icon_html', $icon_html, $network, $url, $network_data );
}

/**
 * Display the social icon HTML.
 *
 * @since  1.0.0
 */
function alcatraz_the_social_network_icons() {

	echo alcatraz_get_the_social_network_icons();
}

/**
 * Build and return the Sub Page Navigation HTML.
 *
 * @since   1.0.0
 *
 * @param   array  $args  The args for wp_list_pages().
 *
 * @return  string        The sub page nav HTML.
 */
function alcatraz_get_the_sub_page_nav( $args = array() ) {

	global $post;

	// Only proceed if we have a post object and we're displaying a page.
	if ( ! $post || ! is_page() ) {
		return false;
	}

	$output   = '';

	// Find the top level page id.
	if ( ! $post->post_parent ) {
		$top_page_id = $post->ID;
	} else {
		$ancestors    = get_post_ancestors( $post );
		$top_page_id = $ancestors ? end( $ancestors ) : $post->ID;
	}

	$default_args = array(
		'depth'       => 5,
		'echo'        => 0,
		'title_li'    => '',
	);
	$args = wp_parse_args( $args, $default_args );

	// Use the top level page id.
	$args['child_of'] = $top_page_id;

	// Generate the page list.
	$page_list = wp_list_pages( $args );

	if ( $page_list ) {

		// Get our top page title.
		$page_title = sprintf(
			'<h2 class="%s"><a href="%s">%s</a></h2>',
			'alcatraz-sub-page-nav-title',
			get_permalink( $top_page_id ),
			get_the_title( $top_page_id )
		);

		$output = sprintf( '<nav class="%s">%s<ul class="%s">%s</ul></nav>',
			'alcatraz-sub-page-nav sub-page-nav',
			$page_title,
			'sub-page-nav-top-level',
			$page_list
		);
	}

	return apply_filters( 'alcatraz_sub_page_nav', $output, $args );
}

/**
 * Display the Sub Page Navigation output.
 *
 * @since  1.0.0
 *
 * @param  array  $args  The args for wp_list_pages().
 */
function alcatraz_the_sub_page_nav( $args = array() ) {

	echo alcatraz_get_the_sub_page_nav( $args );
}
