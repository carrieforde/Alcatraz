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
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
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

	ob_start();

	echo '<header class="entry-header">';

	do_action( 'alcatraz_entry_header_inside', $post_id );

	echo '</header>';

	return apply_filters( 'alcatraz_entry_header', ob_get_clean(), $post_id );
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

	ob_start();

	echo '<footer class="entry-footer">';

	do_action( 'alcatraz_entry_footer_inside', $post_id );

	echo '</footer>';

	return apply_filters( 'alcatraz_entry_footer', ob_get_clean(), $post_id );
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
 * Build and return the social network icon HTML.
 *
 * @since   1.0.0
 *
 * @return  string  The social icon HTML.
 */
function alcatraz_get_social_network_icons() {

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
 * Display the social icon HTML.
 *
 * @since  1.0.0
 */
function alcatraz_the_social_network_icons() {

	echo alcatraz_get_social_network_icons();
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
 * Build and return the Sub Page Navigation HTML.
 *
 * @since   1.0.0
 *
 * @param   array  $args  The args for wp_list_pages().
 *
 * @return  string        The sub page nav HTML.
 */
function alcatraz_get_sub_page_nav( $args = array() ) {

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

	echo alcatraz_get_sub_page_nav( $args );
}

/**
 * Build and return the HTML for a taxonomy term list.
 *
 * @since   1.0.0
 *
 * @param   int     $post_id    The post ID to use.
 * @param   string  $taxonomy   The taxonomy slug to output terms from.
 * @param   string  $label      The label to use.
 * @param   string  $separator  The separation string.
 *
 * @return  string              The term list HTML.
 */
function alcatraz_get_taxonomy_term_list( $post_id = 0, $taxonomy = '', $label = '', $separator = ', ' ) {

	// Taxonomy is required.
	if ( ! $taxonomy ) {
		return '';
	}

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$terms_args = array(
		'orderby' => 'name',
		'order'   => 'ASC',
		'fields'  => 'all',
	);
	$terms_args = apply_filters( 'alcatraz_get_taxonomy_term_list_args', $terms_args, $post_id, $taxonomy );

	$terms = wp_get_post_terms( $post_id, $taxonomy, $terms_args );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}

	$output = sprintf(
		'<div class="%s %s">%s',
		'entry-tax-term-list',
		esc_attr( $taxonomy ) . '-tax-term-list',
		$label
	);

	$i = 0;

	foreach ( $terms as $term_slug => $term_obj ) {
		$output .= sprintf(
			'<a href="%s" rel="%s %s">%s</a>',
			get_term_link( $term_obj->term_id ),
			esc_attr( $term_obj->slug ),
			esc_attr( $term_obj->taxonomy ),
			esc_html( $term_obj->name )
		);

		$i++;

		if ( count( $terms ) > $i ) {
			$output .= $separator;
		}
	}

	$output .= '</div>';

	return apply_filters( 'alcatraz_taxonomy_term_list', $output, $post_id, $taxonomy, $label, $separator );
}

/**
 * Echo the HTML for a taxonomy term list.
 *
 * @since   1.0.0
 *
 * @param   int     $post_id    The post ID to use.
 * @param   string  $taxonomy   The taxonomy slug to output terms from.
 * @param   string  $label      The label to use.
 * @param   string  $separator  The separation string.
 */
function alcatraz_the_taxonomy_term_list( $post_id = 0, $taxonomy = '', $label = '', $separator = ', ' ) {

	echo alcatraz_get_taxonomy_term_list( $post_id, $taxonomy, $label, $separator );
}
