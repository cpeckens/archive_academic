<?
// registration code for courses post type
	function register_courses_posttype() {
		$labels = array(
			'name' 				=> _x( 'Courses', 'post type general name' ),
			'singular_name'		=> _x( 'Course', 'post type singular name' ),
			'add_new' 			=> _x( 'Add New', 'Course'),
			'add_new_item' 		=> __( 'Add New Course '),
			'edit_item' 		=> __( 'Edit Course '),
			'new_item' 			=> __( 'New Course '),
			'view_item' 		=> __( 'View Course '),
			'search_items' 		=> __( 'Search Courses '),
			'not_found' 		=>  __( 'No Course found' ),
			'not_found_in_trash'=> __( 'No Courses found in Trash' ),
			'parent_item_colon' => ''
		);
		
		$taxonomies = array();
		
		$supports = array('title','editor','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Course'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type'   => 'course',
			'map_meta_cap'      => true,			
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'courses', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://soc.dev/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('courses',$post_type_args);
	}
	add_action('init', 'register_courses_posttype');// registration code for slider post type
	function register_slider_posttype() {
		$labels = array(
			'name' 				=> _x( 'Slides', 'post type general name' ),
			'singular_name'		=> _x( 'Slide', 'post type singular name' ),
			'add_new' 			=> _x( 'Add New', 'Slide'),
			'add_new_item' 		=> __( 'Add New Slide '),
			'edit_item' 		=> __( 'Edit Slide '),
			'new_item' 			=> __( 'New Slide '),
			'view_item' 		=> __( 'View Slide '),
			'search_items' 		=> __( 'Search Slides '),
			'not_found' 		=>  __( 'No Slide found' ),
			'not_found_in_trash'=> __( 'No Slides found in Trash' ),
			'parent_item_colon' => ''
		);
		
		$taxonomies = array();
		
		$supports = array('editor','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Slide'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type'   => 'slide',
			'map_meta_cap'      => true,			
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'slider', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://soc.dev/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('slider',$post_type_args);
	}
	add_action('init', 'register_slider_posttype');// registration code for people post type
	function register_people_posttype() {
		$labels = array(
			'name' 				=> _x( 'People', 'post type general name' ),
			'singular_name'		=> _x( 'Person', 'post type singular name' ),
			'add_new' 			=> _x( 'Add New', 'Person'),
			'add_new_item' 		=> __( 'Add New Person '),
			'edit_item' 		=> __( 'Edit Person '),
			'new_item' 			=> __( 'New Person '),
			'view_item' 		=> __( 'View Person '),
			'search_items' 		=> __( 'Search People '),
			'not_found' 		=>  __( 'No Person found' ),
			'not_found_in_trash'=> __( 'No People found in Trash' ),
			'parent_item_colon' => ''
		);
		
		$taxonomies = array();
		
		$supports = array('title','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Person'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type'   => 'person',
			'map_meta_cap'      => true,			
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'directory', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://soc.dev/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('people',$post_type_args);
	}
	add_action('init', 'register_people_posttype');// registration code for bulletinboard post type
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
			'capability_type'   => 'bulletin',
			'map_meta_cap'      => true,			
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'bulletin_board', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://soc.dev/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('bulletinboard',$post_type_args);
	}
	add_action('init', 'register_bulletinboard_posttype');// registration code for profile post type
	function register_profile_posttype() {
		$labels = array(
			'name' 				=> _x( 'Profiles', 'post type general name' ),
			'singular_name'		=> _x( 'Profile', 'post type singular name' ),
			'add_new' 			=> _x( 'Add New', 'Profile'),
			'add_new_item' 		=> __( 'Add New Profile '),
			'edit_item' 		=> __( 'Edit Profile '),
			'new_item' 			=> __( 'New Profile '),
			'view_item' 		=> __( 'View Profile '),
			'search_items' 		=> __( 'Search Profiles '),
			'not_found' 		=>  __( 'No Profile found' ),
			'not_found_in_trash'=> __( 'No Profiles found in Trash' ),
			'parent_item_colon' => ''
		);
		
		$taxonomies = array();
		
		$supports = array('title','editor','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Profile'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type'   => 'profile',
			'map_meta_cap'      => true,			
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'profiles', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://soc.dev/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('profile',$post_type_args);
	}
	add_action('init', 'register_profile_posttype');			

					