<?php
/********************Admin/Dashboard Functions**********************/
//register menus
	add_theme_support( 'menus' );

	function ksas_register_my_menus() {
  		register_nav_menus(
    		array( 'header-menu' => __( 'Header Menu' ))
  		);
  	}
	
	add_action( 'init', 'ksas_register_my_menus' );

//register thumbnail/featured image support
	add_theme_support( 'post-thumbnails' );

	// name of the thumbnail, width, height, crop mode
		add_image_size( 'page-blue', 678, 204, true ); // for blue theme
		add_image_size( 'thumbnail', 75, 75, true );
		add_image_size( 'page-yellow', 678, 280, true ); // for yellow theme

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
				
// add stylesheet for WYSIWYG editor
	function ksasaca_add_editor_style() {
	  add_editor_style( 'style-editor.css' );
	}
	
	add_action( 'after_setup_theme', 'ksasaca_add_editor_style' );

//Add Theme Options Page
	if(is_admin()){	
		require_once('assets/functions/ksasaca-theme-settings-basic.php');
	}
	
	//Collect current theme option values
		function ksasaca_get_global_options(){
			$ksasaca_option = array();
			$ksasaca_option 	= get_option('ksasaca_options');
		return $ksasaca_option;
		}
	
	//Function to call theme options in theme files 
		$ksasaca_option = ksasaca_get_global_options();
		
		
/********************WYSIWYG Editor Modification**********************/

//Add style dropdown to WYSIWYG editor
	function ksasaca_mce_buttons_2($buttons)
	{
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'ksasaca_mce_buttons_2');
	
	function ksasaca_mce_before_init($init_array)
	{
		// add classes using a ; separated values
		$init_array['theme_advanced_styles'] = "Button=button;Divider=divider;Dark Blue=altcolorblue; Yellow=altyellow";
		return $init_array;
	}
	add_filter('tiny_mce_before_init', 'ksasaca_mce_before_init');

// add additional buttons to WYSIWYG editor
	function ksasaca_enable_more_buttons($buttons) {
	  $buttons[] = 'hr';
	  $buttons[] = 'sub';
	  $buttons[] = 'sup'; 
	  return $buttons;
	}
	add_filter("mce_buttons_3", "ksasaca_enable_more_buttons");
	
/********************Functions for Template Files**********************/
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

// add is subpage of conditional statement
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

//Get page ID from page slug - Used to generate left side nav on some pages
	function ksas_get_page_id($page_name){
		global $wpdb;
		$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		return $page_name;
	}
	
// Conditional function to check if post belongs to term in a custom taxonomy. 
	function ksasaca_in_taxonomy($tax, $term, $_post = NULL) {
		// if neither tax nor term are specified, return false
		if ( !$tax || !$term ) { return FALSE; }
		// if post parameter is given, get it, otherwise use $GLOBALS to get post
		if ( $_post ) {
		$_post = get_post( $_post );
		} else {
		$_post =& $GLOBALS['post'];
		}
		// if no post return false
		if ( !$_post ) { return FALSE; }
		// check whether post matches term belongin to tax
		$return = is_object_in_term( $_post->ID, $tax, $term );
		// if error returned, then return false
		if ( is_wp_error( $return ) ) { return FALSE; }
	return $return;
	}

//Change Excerpt Length -- Add to functions.php
	function ksas_new_excerpt_length($length) {
		return 35; //Change word count
	}
	
	add_filter('excerpt_length', 'ksas_new_excerpt_length');
	
/********************DELETE TRANSIENTS ON UPDATES**********************/
function delete_people_transients() {
	if($_POST[post_type] == 'people') {
		delete_transient('ksas_emeriti_query');
		delete_transient('ksas_faculty_query');
		delete_transient('ksas_staff_query');
	}
}
add_action('save_post','delete_people_transients');

function delete_slider_transients() {
	if($_POST[post_type] == 'slider') {
		delete_transient('ksas_slider_query');
	}
}
add_action('save_post','delete_slider_transients');

/********************Includes to Additional Functions**********************/	
// include custom widget functionality, posttypes, taxonomies, and metaboxes
// uncomment the five lines below if using on a single install.  These are now plugins on the network install.
/*
	include_once (TEMPLATEPATH . '/assets/functions/ksasaca-widgets.php'); 
	include_once (TEMPLATEPATH . '/assets/functions/ksasaca-posttypes.php');
	include_once (TEMPLATEPATH . '/assets/functions/ksasaca-taxonomy.php');
	include_once (TEMPLATEPATH . '/assets/functions/ksasaca-metabox.php');
	include_once (TEMPLATEPATH . '/assets/functions/ksasaca-shortcodes.php');
*/	
?>