<?php
/**
 * Template for the Primary Sidebar widget area.
 *
 * @package alcatraz
 */

do_action( 'alcatraz_primary_sidebar' );


function alcatraz_section_nav( $instance ) {
	global $post;
		
		if ( is_search() || is_404() ) return false; //doesn't apply to search or 404 page
		if ( is_front_page() ) return false;	//if we're on the front page and we haven't chosen to show this anyways, leave
		
		if ( is_page() ) {
			if ( isset($post) && is_object($post) ) _get_post_ancestors($post);   //workaround for occassional problems
		} else {
			if ($post_page = get_option("page_for_posts")) $post = get_page($post_page); //treat the posts page as the current page if applicable
			else return false;
		}

		if ( is_front_page() || isset($sub_front_page )) {
			echo "<ul>";
			$children = wp_list_pages(array( 'title_li' => '', 'depth' => 1, 'sort_column' => $instance['sort_by'], 'exclude' => $instance['exclude'], 'echo' => false ));
			echo apply_filters('simple_section_page_list',$children);
			echo "</ul>";
			return true;
	  	}

		$exclude_list = $instance['exclude'];
		$excluded = explode(',', $exclude_list); //convert list of excluded pages to array
		if ( in_array($post->ID,$excluded) && $instance['hide_on_excluded'] ) return false; //if on excluded page, and setup to hide on excluded pages
		
		$post_ancestors = ( isset($post->ancestors) ) ? $post->ancestors : get_post_ancestors($post); //get the current page's ancestors either from existing value or by executing function
		$top_page = $post_ancestors ? end($post_ancestors) : $post->ID; //get the top page id
		
		$thedepth = 0; //initialize default variables
		
		if( !$instance['show_all'] ) {
			$ancestors_me = implode( ',', $post_ancestors ) . ',' . $post->ID;
			
			//exclude pages not in direct hierarchy
			foreach ($post_ancestors as $anc_id) 
			{
				if ( in_array($anc_id,$excluded) && $instance['hide_on_excluded'] ) return false; //if ancestor excluded, and hide on excluded, leave
				
				$pageset = get_pages(array( 'child_of' => $anc_id, 'parent' => $anc_id, 'exclude' => $ancestors_me ));
				foreach ($pageset as $page) {
					$excludeset = get_pages(array( 'child_of' => $page->ID, 'parent' => $page->ID ));
					foreach ($excludeset as $expage) { $exclude_list .= ',' . $expage->ID; }
				}
			}
			
			$thedepth = count($post_ancestors)+1; //prevents improper grandchildren from showing
		}		
		
		$children = wp_list_pages(array( 'title_li' => '', 'echo' => 0, 'depth' => $thedepth, 'child_of' => $top_page, 'sort_column' => $instance['sort_by'], 'exclude' => $exclude_list ));	//get the list of pages, including only those in our page list
		if( !$children && !$instance['show_empty'] ) return false; 	//if there are no pages in this section, and use hasnt chosen to display widget anyways, leave the function
		
		$sect_title = ( $instance['title'] ) ? apply_filters( 'the_title', $instance['title'] ) : apply_filters( 'the_title', get_the_title($top_page), $top_page );
		$sect_title = apply_filters( 'simple_section_nav_title', $sect_title );
		if ($instance['a_heading']) {
			$headclass = ( $post->ID == $top_page ) ? "current_page_item" : "current_page_ancestor";
			if ( $post->post_parent == $top_page ) $headclass .= " current_page_parent";
			$sect_title = '<a href="' . get_page_link($top_page) . '" id="toppage-' . $top_page . '" class="' . $headclass . '">' . $sect_title . '</a>';	
		}
	  	
		echo "<ul>";
		echo apply_filters( 'simple_section_page_list', $children );
		echo "</ul>";
	}

echo alcatraz_section_nav();

