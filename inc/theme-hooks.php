<?php
/**
 * Alcatraz Theme Hooks.
 *
 * This file contains any output that is included on the alcatraz_* hooks.
 *
 * @package alcatraz
 */

add_action( 'alcatraz_before_header_inside', 'alcatraz_output_header_image', 0 );
/**
 * Maybe output a Header image.
 *
 * @since  1.0.0
 */
function alcatraz_output_header_image() {

	if ( apply_filters( 'alcatraz_enable_custom_header', false ) && get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-image-wrap" rel="home">
			<img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
		</a>
	<?php endif;
}

add_action( 'alcatraz_header', 'alcatraz_output_site_title', 5 );
/**
 * Output the site title.
 *
 * @since  1.0.0
 */
function alcatraz_output_site_title() {

	if ( is_front_page() && is_home() ) {
		printf(
			'<h1 class="site-title"><a href="%s" rel="home">%s</a></h1>',
			esc_url( home_url( '/' ) ),
			get_bloginfo( 'name' )
		);
	} else {
		printf(
			'<p class="site-title"><a href="%s" rel="home">%s</a></p>',
			esc_url( home_url( '/' ) ),
			get_bloginfo( 'name' )
		);
	}
}

add_action( 'alcatraz_header', 'alcatraz_output_site_description', 15 );
/**
 * Output the site description.
 *
 * @since  1.0.0
 */
function alcatraz_output_site_description() {

	$description = get_bloginfo( 'description', 'display' );

	if ( $description || is_customize_preview() ) {
		printf(
			'<p class="%s">%s</p>',
			'site-description',
			$description
		);
	}
}

add_action( 'alcatraz_header', 'alcatraz_output_logo', 2 );
/**
 * Output the site logo.
 *
 * @since  1.0.0
 */
function alcatraz_output_logo() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['logo_id'] ) || ! empty( $options['mobile_logo_id'] ) ) {

    	echo '<div class="logo-wrap">';

        printf(
            '<a href="%s" title="%s" rel="home">',
            esc_url( home_url( '/' ) ),
            esc_attr( get_bloginfo( 'name', 'display' ) )
        );

        if ( ! empty( $options['logo_id'] ) ) {

            printf(
                '<img class="logo logo-regular" src="%s" alt="%s">',
                esc_url( wp_get_attachment_image_src( $options['logo_id'], 'full' )[0] ),
                esc_attr( get_bloginfo( 'name', 'display' ) )
            );

        }

        if ( ! empty( $options['mobile_logo_id'] ) ) {
            printf(
                '<img class="logo logo-mobile" src="%s" alt="%s">',
                esc_url( wp_get_attachment_image_src( $options['mobile_logo_id'], 'full' )[0] ),
                esc_attr( get_bloginfo( 'name', 'display' ) )
            );
        }

        echo '</a>';

        echo '</div>';
    }
}

add_action( 'alcatraz_footer', 'alcatraz_output_footer_bottom', 30 );
/**
 * Output the footer bottom.
 *
 * @since  1.0.0
 */
function alcatraz_output_footer_bottom() {

	$options = get_option( 'alcatraz_options' );

	if ( ! empty( $options['footer_bottom'] ) ) {
		printf(
			'<div class="footer-bottom">%s</div>',
			wp_kses_post( do_shortcode( $options['footer_bottom'] ) )
		);
	}
}


add_action( 'alcatraz_primary_sidebar', 'alcatraz_sidebar_nav_menu', 10);
/**
 * Output the sidebar nav.
 *
 * @since  1.0.0
 */

function alcatraz_sidebar_nav_menu() {

	global $post;

	$args = array();

	//defaults
	$defaults = array(
		'show_all'         => false,
		'show_on_home'     => false,
		'show_empty'       => false,
		'sort_by'          => 'menu_order',
		'a_heading'        => false,
		'before_widget'    => '<div>',
		'after_widget'     => '</div>',
		'before_title'     => '<h2 class="side-nav-title">',
		'after_title'      => '</h2>',
		'title'            => ''
	);

	$args = wp_parse_args( (array)$args, $defaults );

	// Get clean param values.
	$show_all         = $args['show_all'];
	$show_on_home     = $args['show_on_home'];
	$show_empty       = $args['show_empty'];
	$sort_by          = $args['sort_by'];
	$a_heading        = $args['a_heading'];
	$before_widget    = $args['before_widget'];
	$after_widget     = $args['after_widget'];
	$before_title     = $args['before_title'];
	$after_title      = $args['after_title'];
	$title            = $args['title'];

	if ( is_search() || is_404() ) {
		return false; //doesn't apply to search or 404 page
	}

	if ( is_front_page() ) {
		return false;	//if we're on the front page and we haven't chosen to show this anyways, leave
	}

	if ( is_page() ) {

		if ( isset( $post) && is_object($post ) ) {
		get_post_ancestors($post);
   		//workaround for occassional problems
		} else {

			if ($post_page = get_option("page_for_posts")) {

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


		$thedepth = count($post_ancestors)+1; //prevents improper grandchildren from showing

		$children = wp_list_pages(array(
		'title_li'    => '',
		'echo'        => 0,
		'depth'       => $thedepth,
		'child_of'    => $top_page,
		'sort_column' => $sort_by
		 ));	//get the list of pages, including only those in our page list

		if( ! $children && ! $show_empty) {
			return false; 	//if there are no pages in this section, and use hasnt chosen to display widget anyways, leave the function
		}

		$sect_title = ( $title ) ? $title : $top_page;
		$sect_title = $sect_title;

		if ( $a_heading ) {
			$headclass = ( $post->ID == $top_page ) ? "current_page_item" : "current_page_ancestor";
			if ( $post->post_parent == $top_page ) {
				$headclass .= " current_page_parent";
			}
			$sect_title = '<a href="' . get_page_link($top_page) . '" id="toppage-' . $top_page . '" class="' . $headclass . '">' . $sect_title . '</a>';
		}

		echo "<ul>";
		echo $children;
		echo "</ul>";
	}

}

