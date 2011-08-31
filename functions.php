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
	
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Homepage Sidebar',
			'id'            => 'homepage-sb',
			'description'   => '',
			'before_widget' => '<div id="homepage-widget" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
			));
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Graduate Sidebar',
			'id'            => 'graduate-sb',
			'description'   => '',
			'before_widget' => '<div id="grad-widget" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
			));
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Undergrad Sidebar',
			'id'            => 'undergrad-sb',
			'description'   => '',
			'before_widget' => '<div id="undergrad-widget" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
			));
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Department Address',
			'id'            => 'address-sb',
			'description'   => '',
			'before_widget' => '<div id="address-widget" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
			));	

//Get page ID from Slug
	function ksas_get_page_id($page_name){
		global $wpdb;
		$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		return $page_name;
	}

// remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

	// remove version info from head and feeds
		function complete_version_removal() {
			return '';
		}
		
		add_filter('the_generator', 'complete_version_removal');

// Add meta box stylesheet
	add_action("admin_head", "ksas_admin_stylesheet");
	
	function ksas_admin_stylesheet () {
		echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/assets/css/meta.css" type="text/css" media="screen" />';
	}

//Add AJAX file upload capability
//Save image via AJAX
add_action('wp_ajax_ksas_ajax_upload', 'ksas_ajax_upload'); //Add support for AJAX save

function ksas_ajax_upload(){
	
	global $wpdb; //Now WP database can be accessed
	
	
	$image_id=$_POST['data'];
	$image_filename=$_FILES[$image_id];	
	$override['test_form']=false; //see http://wordpress.org/support/topic/269518?replies=6
	$override['action']='wp_handle_upload';    
	
	$uploaded_image = wp_handle_upload($image_filename,$override);
	
	if(!empty($uploaded_image['error'])){
		echo 'Error: ' . $uploaded_image['error'];
	}	
	else{ 
		update_option($image_id, $uploaded_image['url']);		 
		echo $uploaded_image['url'];
	}
			
	die();

}

//Change Excerpt Length -- Add to functions.php
function ksas_new_excerpt_length($length) {
	return 35; //Change word count
}
add_filter('excerpt_length', 'ksas_new_excerpt_length');
		
// include People Directory and Profiles functionality
	include_once (TEMPLATEPATH . '/assets/functions/people-directory.php');
	include_once (TEMPLATEPATH . '/assets/functions/people-profiles.php');
	include_once (TEMPLATEPATH . '/assets/functions/widget-profiles.php');
	include_once (TEMPLATEPATH . '/assets/functions/courses-directory.php');




?>