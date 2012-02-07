<?php


// registration code for coursetype taxonomy
function register_coursetype_tax() {
	$labels = array(
		'name' 					=> _x( 'Course Types', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Course Type', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Course Type', 'Course Type'),
		'add_new_item' 			=> __( 'Add New Course Type' ),
		'edit_item' 			=> __( 'Edit Course Type' ),
		'new_item' 				=> __( 'New Course Type' ),
		'view_item' 			=> __( 'View Course Type' ),
		'search_items' 			=> __( 'Search Course Types' ),
		'not_found' 			=> __( 'No Course Type found' ),
		'not_found_in_trash' 	=> __( 'No Course Type found in Trash' ),
	);
	
	$pages = array('courses');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Course Type'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'coursetype', 'with_front' => false ),
	 );
	register_taxonomy('coursetype', $pages, $args);
}
add_action('init', 'register_coursetype_tax');
// registration code for academicdepartment taxonomy
function register_academicdepartment_tax() {
	$labels = array(
		'name' 					=> _x( 'Departments', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Department', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Department', 'Department'),
		'add_new_item' 			=> __( 'Add New Department' ),
		'edit_item' 			=> __( 'Edit Department' ),
		'new_item' 				=> __( 'New Department' ),
		'view_item' 			=> __( 'View Department' ),
		'search_items' 			=> __( 'Search Departments' ),
		'not_found' 			=> __( 'No Department found' ),
		'not_found_in_trash' 	=> __( 'No Department found in Trash' ),
	);
	
	$pages = array('courses','people','profile');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Department'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'department', 'with_front' => false ),
	 );
	register_taxonomy('academicdepartment', $pages, $args);
}
add_action('init', 'register_academicdepartment_tax');
// registration code for role taxonomy
function register_role_tax() {
	$labels = array(
		'name' 					=> _x( 'Roles', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Role', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Role', 'Role'),
		'add_new_item' 			=> __( 'Add New Role' ),
		'edit_item' 			=> __( 'Edit Role' ),
		'new_item' 				=> __( 'New Role' ),
		'view_item' 			=> __( 'View Role' ),
		'search_items' 			=> __( 'Search Roles' ),
		'not_found' 			=> __( 'No Role found' ),
		'not_found_in_trash' 	=> __( 'No Role found in Trash' ),
	);
	
	$pages = array('people');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Role'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'role', 'with_front' => false ),
	 );
	register_taxonomy('role', $pages, $args);
}
add_action('init', 'register_role_tax');
// registration code for profiletype taxonomy
function register_profiletype_tax() {
	$labels = array(
		'name' 					=> _x( 'Profile Types', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Profile Type', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Profile Type', 'Profile Type'),
		'add_new_item' 			=> __( 'Add New Profile Type' ),
		'edit_item' 			=> __( 'Edit Profile Type' ),
		'new_item' 				=> __( 'New Profile Type' ),
		'view_item' 			=> __( 'View Profile Type' ),
		'search_items' 			=> __( 'Search Profile Types' ),
		'not_found' 			=> __( 'No Profile Type found' ),
		'not_found_in_trash' 	=> __( 'No Profile Type found in Trash' ),
	);
	
	$pages = array('profile');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Profile Type'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'profiletype', 'with_front' => false ),
	 );
	register_taxonomy('profiletype', $pages, $args);
}
add_action('init', 'register_profiletype_tax');								
?>