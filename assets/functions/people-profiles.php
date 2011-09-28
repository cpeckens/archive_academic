<?php

add_action("init", "profile_directory_plugin");

function profile_directory_plugin() {

//Create labels
$labels = array(
		'name' => _x('Profiles', 'post type general name'),
		'singular_name' => _x('Profile', 'post type singular name'),
		'add_new' => _x('Add New', 'Profile'),
		'add_new_item' => __('Add New Profile'),
		'edit_item' => __('Edit Profile'),
		'new_item' => __('New Profile'),
		'view_item' => __('View Profile'),
		'search_items' => __('Search profiles'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

//Register custom post type

register_post_type('profile', array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true, // UI in admin panel
	'_builtin' => false, // It's a custom post type, not built in!
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array("slug" => "profiles"), // Permalinks format
	'query_var' => "profiles", // This goes to the WP_Query schema
	'supports' => array('title', 'editor'),
	'can_export' => true,
));




//add taxonomies for Department and Role (faculty, staff, graduate student, etc.)
register_taxonomy("profile_type", array("profile"), array("hierarchical" => true, "label" => "Profile Types", "singular_label" => "Profile Type", "rewrite" => true));
register_taxonomy("academic_area", array("profile"), array("hierarchical" => true, "label" => "Academic Areas", "singular_label" => "Academic Area", "rewrite" => true));

}



//Create Meta boxes
// Intiate create meta boxes
add_action("admin_init", "create_profile_meta_boxes");
function create_profile_meta_boxes(){
	add_meta_box("profile_details", "Pull Quote", "profile_details", "profile", "normal", "high");
	add_meta_box("profile_uploads", "Uploads", "profile_uploads", "profile", "side", "high");
}

//function to create pull quote meta box
function profile_details() {
  global $post;
  $custom = get_post_custom($post->ID);
  $pull_quote = $custom["pull_quote"][0];
  
  ?>
  <div class="meta-group">  
  <div class="meta-box meta-box-large"><strong>Pull Quote:</strong><br><textarea name="pull_quote"><?php echo $pull_quote; ?></textarea></div>
  </div>
    <div class="clear"></div>

  <?php
}

//function to create uploads meta box
function profile_uploads() {
  global $post;
  $custom = get_post_custom($post->ID);
  $profile_photo = $custom["profile_photo"][0];
  ?>
  
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#uploadPhoto').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#profile_photo');
            var image_id = jQuery(this).attr('id');

            new AjaxUpload(image_id, {

                action: ajaxurl,
                name: image_id,

                // Additional data
                data: {
                    action: 'ksas_ajax_upload',
                    data: image_id
                },

                autoSubmit: true,
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension) {

                    the_button.attr('disabled', 'disabled').val("Uploading...");

                },

                onComplete: function(file, response) {

                    the_button.removeAttr('disabled').val("Upload Image");

                    if(response.search("Error") > -1){

                        alert("There was an error uploading:\n"+response);

                    }

                    else{

                        image_input.val(response);

                    }

                }
            });
        });

    });

</script>
<p>

    <label for="profile_photo"><strong>Upload Profile Photo:</strong></label>
    <input type="text" class="widefat" name="profile_photo" id="profile_photo" value="<?php echo $profile_photo; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="uploadPhoto" value="Upload Image" />

</p>

   <?php
}





// Save meta 
add_action('save_post', 'profile_save_details');
//Save and update function
function profile_save_details(){
	if ( 'profile' == get_post_type() ) {  
  global $post;
  update_post_meta($post->ID, "profile_photo", $_POST["profile_photo"]);
  update_post_meta($post->ID, "pull_quote", $_POST["pull_quote"]);
}
}


//Configuring Admin Columns - in View all profile
add_action("manage_posts_custom_column",  "profile_custom_columns");
add_filter("manage_edit-profile_columns", "profile_edit_columns");
 
function profile_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "academic_area" => "Academic Areas",
    "profile_type" => "Profile Type",
  );
 
  return $columns;
}
function profile_custom_columns($column){
  global $post;
 
  switch ($column) {
  case "academic_area":
      echo get_the_term_list($post->ID, 'academic_area', '', ', ','');
      break;
  case "profile_type":
      echo get_the_term_list($post->ID, 'profile_type', '', ', ','');
      break;
    
  }
}
// Initiate flush rewrite rules
register_activation_hook(__FILE__, 'profile_rewrite_flush');
//Flush rewrite rules
function profile_rewrite_flush() {
  profile_directory_plugin();
  flush_rewrite_rules();
}


?>