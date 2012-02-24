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
		add_image_size( 'page-blue', 678, 204, true );
		add_image_size( 'thumbnail', 75, 75, true );
		add_image_size( 'page-yellow', 678, 280, true );

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

//check course type
function has_course_type( $the_course, $_post = null ) {
	if ( empty( $the_course ) )
		return false;

	if ( $_post )
		$_post = get_post( $_post );
	else
		$_post =& $GLOBALS['post'];

	if ( !$_post )
		return false;

	$course_answer = is_object_in_term( $_post->ID, 'coursetype', $the_course );

	if ( is_wp_error( $r ) )
		return false;

	return $course_answer;
}

//Change Excerpt Length -- Add to functions.php
function ksas_new_excerpt_length($length) {
	return 35; //Change word count
}
add_filter('excerpt_length', 'ksas_new_excerpt_length');

//Add iframe shortcode
if ( !function_exists( 'iframe_embed_shortcode' ) ) {
	function iframe_embed_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'width' => '100%',
			'height' => '480',
			'src' => '',
			'frameborder' => '0',
			'scrolling' => 'no',
			'marginheight' => '0',
			'marginwidth' => '0',
			'allowtransparency' => 'true',
			'id' => '',
			'class' => 'iframe-class',
			'same_height_as' => ''
		), $atts));
		$src_cut = substr($src, 0, 35);
		if(strpos($src_cut, 'maps.google' )){
			$google_map_fix = '&output=embed';
		}else{
			$google_map_fix = '';
		}
		$return = '';
		if( $id != '' ){
			$id_text = 'id="'.$id.'" ';
		}else{
			$id_text = '';
		}
		$return .= '<div class="video-container"><iframe '.$id_text.'class="'.$class.'" width="'.$width.'" height="'.$height.'" src="'.$src.$google_map_fix.'" frameborder="'.$frameborder.'" scrolling="'.$scrolling.'" marginheight="'.$marginheight.'" marginwidth="'.$marginwidth.'" allowtransparency="'.$allowtransparency.'" webkitAllowFullScreen allowFullScreen></iframe></div>';
		// &amp;output=embed
		return $return;
	}
	add_shortcode('iframe', 'iframe_embed_shortcode');
}

// Add conditional statement for people type
function has_role( $role, $_post = null ) {
	if ( empty( $role ) )
		return false;
	if ( $_post )
		$_post = get_post( $_post );
	else
		$_post =& $GLOBALS['people'];
	if ( !$_post )
		return false;
	$r = is_object_in_term( $_post->ID, 'role', $role );
	if ( is_wp_error( $r ) )
		return false;
	return $r;
}
// add WYSIWYG stylesheet
function ksasaca_add_editor_style() {
  add_editor_style( 'style-editor.css' );
}
add_action( 'after_setup_theme', 'ksasaca_add_editor_style' );

	
// include custom widget functionality
	include_once (TEMPLATEPATH . '/assets/functions/widget-profiles.php');
	
//include theme settings page
	
//require only in admin!
if(is_admin()){	
	require_once('assets/functions/ksasaca-theme-settings-basic.php');
}

 /**
 * Collects our theme options
 *
 * @return array
 */
function ksasaca_get_global_options(){
	
	$ksasaca_option = array();

	$ksasaca_option 	= get_option('ksasaca_options');
	
return $ksasaca_option;
}

 /**
 * Call the function and collect in variable
 *
 * Should be used in template files like this:
 * <?php echo $ksasaca_option['ksasaca_txt_input']; ?>
 *
 * Note: Should you notice that the variable ($ksasaca_option) is empty when used in certain templates such as header.php, sidebar.php and footer.php
 * you will need to call the function (copy the line below and paste it) at the top of those documents (within php tags)!
 */ 
$ksasaca_option = ksasaca_get_global_options();
?>