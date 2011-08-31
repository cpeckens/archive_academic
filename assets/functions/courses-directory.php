<?php

add_action("init", "course_directory_plugin");

function course_directory_plugin() {

//Create labels
$labels = array(
		'name' => _x('Courses', 'post type general name'),
		'singular_name' => _x('Course', 'post type singular name'),
		'add_new' => _x('Add New', 'Course'),
		'add_new_item' => __('Add New Course'),
		'edit_item' => __('Edit Course'),
		'new_item' => __('New Course'),
		'view_item' => __('View Course'),
		'search_items' => __('Search Courses'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

//Register custom post type

register_post_type('course', array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true, // UI in admin panel
	'_builtin' => false, // It's a custom post type, not built in!
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array("slug" => "courses"), // Permalinks format
	'query_var' => "courses", // This goes to the WP_Query schema
	'supports' => array('title', 'editor', 'revisions'),
	'can_export' => true,
));




//add taxonomies for Department and Role (faculty, staff, graduate student, etc.)
register_taxonomy("course_type", array("course"), array("hierarchical" => true, "label" => "Course Types", "singular_label" => "Course Type", "rewrite" => true));
register_taxonomy("academic_department", array("course"), array("hierarchical" => true, "label" => "Academic Department", "singular_label" => "Academic Area", "rewrite" => true));

}



//Create Meta boxes
// Intiate create meta boxes
add_action("admin_init", "create_course_meta_boxes");
function create_course_meta_boxes(){
	add_meta_box("course_details", "Course Details", "course_details", "course", "normal", "high");
	
}

//function to create pull quote meta box
function course_details() {
  global $post;
  $custom = get_post_custom($post->ID);
  $credits = $custom["credits"][0];
  $instructor = $custom["instructor"][0];
  $prereqs = $custom["prereqs"][0];
  $course_website = $custom["course_website"][0];
  $course_times = $custom["course_times"][0];
  $class_limit = $custom["class_limit"][0];


  ?>
  <div class="meta-group">  
  <div class="meta-box"><strong>Credits:</strong><br><input size="30" name="credits" value="<?php echo $credits; ?>"></input></div>
  <div class="meta-box"><strong>Instructor:</strong><br><input size="30" name="instructor" value="<?php echo $instructor; ?>"></input></div>
  <div class="meta-box"><strong>Prerequisites:</strong><br>
  <textarea cols="30" rows="3" name="prereqs" value="<?php echo $prereqs; ?>"><?php echo $prereqs; ?></textarea></div>
  </div>
<div class="clear"></div>
<div class="divider"></div>
  <div class="meta-group">  
    <div class="meta-box"><strong>Course Website:</strong><br>&nbsp;<input size="30" name="course_website" value="<?php echo $course_website; ?>"></input></div>
     <div class="meta-box"><strong>Course Times:</strong><br>&nbsp;<input size="30" name="course_times" value="<?php echo $course_times; ?>"></input></div>
      <div class="meta-box"><strong>Course Limit:</strong><br>&nbsp;<input size="30" name="class_limit" value="<?php echo $class_limit; ?>"></input></div>
       </div>
    <div class="clear"></div>


  <?php
}



// Save meta 
add_action('save_post', 'course_save_details');
//Save and update function
function course_save_details(){
	if ( 'course' == get_post_type() ) {  
		global $post;
  			update_post_meta($post->ID, "credits", $_POST["credits"]);
  			update_post_meta($post->ID, "instructor", $_POST["instructor"]);
  			update_post_meta($post->ID, "prereqs", $_POST["prereqs"]);
  			update_post_meta($post->ID, "course_website", $_POST["course_website"]);
  			update_post_meta($post->ID, "course_times", $_POST["course_times"]);
  			update_post_meta($post->ID, "class_limit", $_POST["class_limit"]);
}

}
	


//Configuring Admin Columns - in View all course
add_action("manage_posts_custom_column",  "course_custom_columns");
add_filter("manage_edit-course_columns", "course_edit_columns");
 
function course_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "course_type" => "Course Type",
    "instructor" => "Instructor",
  );
 
  return $columns;
}
function course_custom_columns($column){
  global $post;
 
  switch ($column) {
  
  case "course_type":
      echo get_the_term_list($post->ID, 'course_type', '', ', ','');
      break;
  case "instructor":
      $custom = get_post_custom();
      echo $custom["instructor"][0];
      break;
  }
}
// Initiate flush rewrite rules
register_activation_hook(__FILE__, 'course_rewrite_flush');
//Flush rewrite rules
function course_rewrite_flush() {
  course_directory_plugin();
  flush_rewrite_rules();
}


?>