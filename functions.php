<?php

//add menu support
	add_theme_support( 'menus' );

//register menus
	function ksas_register_my_menus() {
  		register_nav_menus(
    		array( 'header-menu' => __( 'Header Menu' ), 'mobile-menu' => __( 'Mobile Menu' ))
  		);
	}
	
	// initiate register menus
		add_action( 'init', 'ksas_register_my_menus' );



//register thumbnail/featured image support
	add_theme_support( 'post-thumbnails' );

	// name of the thumbnail, width, height, crop mode
		add_image_size( 'page-image', 678, 204, true );
		add_image_size( 'thumbnail', 75, 75, true );


//pagination function
	function ksas_pagination($prev = '«', $next = '»') {
    	global $wp_query, $wp_rewrite;
    	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    	$pagination = array(
    	    'base' => @add_query_arg('paged','%#%'),
    	    'format' => '',
    	    'total' => $wp_query->max_num_pages,
    	    'current' => $current,
    	    'prev_text' => __($prev),
    	    'next_text' => __($next),
    	    'type' => 'plain'
		);		
    	if( $wp_rewrite->using_permalinks() )
    	    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
		
    	if( !empty($wp_query->query_vars['s']) )
    	    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
		
    	echo paginate_links( $pagination );
	};		

// addd is subpage of conditional statement
	function ksas_is_subpage_of( $parentpage = '' ) {
	
		$posts = $GLOBALS['posts'];
	
		if ( is_numeric($parentpage) ) {
			if ( $parentpage == $posts[0]->post_parent ) {
				return true;
			} else {
				is_subpage_of( $posts[0]->post_parent );
			}
		} else {
			return false;
		}
	}


//register sidebars
	function ksas_register_sidebars() {
	
		register_sidebar(array(
			'name'          => 'Homepage Sidebar',
			'id'            => 'homepage-sidebar',
			'description'   => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
			));
}
include_once (TEMPLATEPATH . '/assets/functions/people-directory.php');

?>