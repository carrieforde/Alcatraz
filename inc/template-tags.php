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
function alcatraz_get_posted_on( $post_id = 0 ) {

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
 * Build and echo the "Posted on ..." HTML.
 *
 * @param  int  $post_id  The post ID to use (optional).
 */
function alcatraz_posted_on( $post_id = 0 ) {
	echo alcatraz_get_posted_on( $post_id );
}

/**
 * Build the edit post link HTML.
 *
 * @since 1.0.0
 */
function alcatraz_edit_post() {

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
 * Build and echo the entry header HTML.
 *
 * @since  1.0.0
 */
function alcatraz_entry_header() {

	$header = sprintf(
		'<header class="entry-header">%s%s</header>',
		alcatraz_entry_title(),
		alcatraz_entry_meta()
	);

	return apply_filters( 'alcatraz_entry_header', $header );
}

/**
 * Echo the entry header HTML.
 *
 * @since 1.0.0
 */
function alcatraz_the_entry_header() {

	echo alcatraz_entry_header();
}

/**
 * Build and echo the entry title HTML.
 *
 * @since  1.0.0
 */
function alcatraz_entry_title() {

	$hide_title = get_post_meta( get_the_ID(), '_alcatraz_hide_title', true );

	if ( is_singular() ) {

		// Don't output anything if the hide_title meta value is set to true.
		$title = ( 'on' === $hide_title ) ? '' : the_title(
			'<h1 class="entry-title">',
			'</h1>',
			false
		);

	} else {

		$title = the_title(
			sprintf(
				'<h2 class="entry-title"><a href="%s" rel="bookmark">',
				esc_url( get_permalink() )
			),
			'</a></h2>',
			false
		);
	}

	return apply_filters( 'alcatraz_entry_title', $title );
}

/**
 * Display the Alcatraz entry title.
 */
function alcatraz_the_entry_title() {

	echo alcatraz_entry_title();
}

/**
 * Build and echo the entry meta HTML.
 *
 * @since  1.0.0
 */
function alcatraz_entry_meta() {

	$meta = '';

	if ( 'post' === get_post_type() ) {
		$meta = sprintf( '<div class="entry-meta">%s</div>',
			alcatraz_get_posted_on()
		);
	}

	return apply_filters( 'alcatraz_entry_meta', $meta );
}

/**
 * Display the Alcatraz entry meta.
 */
function alcatraz_the_entry_meta() {

	echo alcatraz_entry_meta();
}

/**
 * Build and echo the entry footer HTML.
 *
 * @since  1.0.0
 */
function alcatraz_entry_footer() {

	// Hide category and tag text for pages.
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'alcatraz' ), esc_html__( '1 Comment', 'alcatraz' ), esc_html__( '% Comments', 'alcatraz' ) );
		echo '</span>';
	}

	if ( 'post' === get_post_type() ) {

		echo '<hr>';

		$categories_list = get_the_category_list( esc_html__( ', ', 'alcatraz' ) );
		if ( $categories_list && alcatraz_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in: %1$s', 'alcatraz' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'alcatraz' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'alcatraz' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
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
