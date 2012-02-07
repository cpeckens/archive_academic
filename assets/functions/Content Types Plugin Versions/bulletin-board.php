<?php 
// registration code for bulletinboard post type
	function register_bulletinboard_posttype() {
		$labels = array(
			'name' 				=> _x( 'Bulletins', 'post type general name' ),
			'singular_name'		=> _x( 'Bulletin', 'post type singular name' ),
			'add_new' 			=> _x( 'Add New', 'Bulletin'),
			'add_new_item' 		=> __( 'Add New Bulletin '),
			'edit_item' 		=> __( 'Edit Bulletin '),
			'new_item' 			=> __( 'New Bulletin '),
			'view_item' 		=> __( 'View Bulletin '),
			'search_items' 		=> __( 'Search Bulletins '),
			'not_found' 		=>  __( 'No Bulletin found' ),
			'not_found_in_trash'=> __( 'No Bulletins found in Trash' ),
			'parent_item_colon' => ''
		);
		
		$taxonomies = array();
		
		$supports = array('title','editor','thumbnail','excerpt','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Bulletin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'bulletin_board', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('bulletinboard',$post_type_args);
	}
	add_action('init', 'register_bulletinboard_posttype');


?>