<?php

add_action("init", "people_directory_plugin");

function people_directory_plugin() {

//Create labels
$labels = array(
		'name' => _x('People', 'post type general name'),
		'singular_name' => _x('Person', 'post type singular name'),
		'add_new' => _x('Add New', 'Person'),
		'add_new_item' => __('Add New Person'),
		'edit_item' => __('Edit Person'),
		'new_item' => __('New Person'),
		'view_item' => __('View Person'),
		'search_items' => __('Search People'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

//Register custom post type

register_post_type('people', array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true, // UI in admin panel
	'_builtin' => false, // It's a custom post type, not built in!
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array("slug" => "directory"), // Permalinks format
	'query_var' => "people", // This goes to the WP_Query schema
	'supports' => array('title', 'revisions', 'custom-fields'),
	'can_export' => true,
));




//add taxonomies for Department and Role (faculty, staff, graduate student, etc.)
register_taxonomy("Role", array("people"), array("hierarchical" => true, "label" => "Roles", "singular_label" => "Role", "rewrite" => true));
register_taxonomy("Department", array("people"), array("hierarchical" => true, "label" => "Departments", "singular_label" => "Department", "rewrite" => true));

}



//Create Meta boxes
// Intiate create meta boxes
add_action("admin_init", "create_meta_boxes");
function create_meta_boxes(){

  add_meta_box("people_details", "Personal Details", "people_details", "people", "normal", "low");
  add_meta_box("people_uploads", "Uploads", "people_uploads", "people", "side", "high");
}

add_action("admin_head", "ksas_admin_stylesheet");
function ksas_admin_stylesheet () {


echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/assets/css/meta.css" type="text/css" media="screen" />';



}




//Style and label meta boxes	
function people_details() {
  global $post;
  $custom = get_post_custom($post->ID);
  $position = $custom["position"][0];
  $degrees = $custom["degrees"][0];
  $expertise = $custom["expertise"][0];
  $phone = $custom["phone"][0];
  $email = $custom["email"][0];
  $office = $custom["office"][0];
  $hours = $custom["hours"][0];
  $website = $custom["website"][0];
  $bio = $custom["bio"][0];
  $research = $custom["research"][0];
  $teaching = $custom["teaching"][0];
  $publications = $custom["publications"][0];
  $extra_tab_title = $custom["extra_tab_title"][0];
  $extra_tab = $custom["extra_tab"][0];

  ?>
  <div class="meta-group">  
  <div class="meta-box"><strong>Title/Position:</strong><br><input size="30" name="position" value="<?php echo $position; ?>"></input></div>
  <div class="meta-box"><strong>Degrees:</strong><br>
  <textarea cols="30" rows="3" name="degrees" value="<?php echo $degrees; ?>"><?php echo $degrees; ?></textarea></div>
  <div class="meta-box"><strong>Expertise/Research Interests:</strong><br>
  <textarea cols="30" rows="3" name="expertise" value="<?php echo $expertise; ?>"><?php echo $expertise; ?></textarea></div>
  </div>
<div class="clear"></div>
<h3>Contact Information</h3>
<div class="divider"></div>
  <div class="meta-group">  
    <div class="meta-box"><strong>Phone Number:</strong><br>&nbsp;<input size="30" name="phone" value="<?php echo $phone; ?>"></input></div>
    <div class="meta-box"><strong>Email Address:</strong><br>&nbsp;<input size="30" name="email" value="<?php echo $email; ?>"></input></div>
    <div class="meta-box"><strong>Office Location:</strong><br>&nbsp;<input size="30" name="office" value="<?php echo $office; ?>"></input></div>
    <div class="meta-box"><strong>Office Hours:</strong><br>&nbsp;<input size="30" name="hours" value="<?php echo $hours; ?>"></input></div>
    <div class="meta-box"><strong>Personal Website:</strong><br>&nbsp;<input size="30" name="website" value="<?php echo $website; ?>"></input></div>
    </div>
    <div class="clear"></div>
    <h3>Additional Details</h3>
    <div class="divider"></div>
      <div class="meta-group">  
    <div class="meta-box meta-box-large"><strong>Bio:</strong><br><textarea name="bio" value="<?php echo $bio; ?>"><?php echo $bio; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Research:</strong><br>&nbsp;<textarea name="research" value="<?php echo $research; ?>"><?php echo $research; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Teaching:</strong><br>&nbsp;<textarea name="teaching" value="<?php echo $teaching; ?>"><?php echo $teaching; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Publications:</strong><br>&nbsp;<textarea name="publications" value="<?php echo $publications; ?>"><?php echo $publications; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box"><strong>Extra Tab Title:</strong><br>&nbsp;<input size="30" name="extra_tab_title" value="<?php echo $extra_tab_title; ?>"></input></div>
    <div class="meta-box meta-box-large"><strong>Extra Tab Content:</strong><br>&nbsp;<textarea name="extra_tab" value="<?php echo $extra_tab; ?>"><?php echo $extra_tab; ?></textarea></div>
    </div>
    <div class="clear"></div>

  <?php
}
	


function people_uploads() {
  global $post;
  $custom = get_post_custom($post->ID);
  $people_photo = $custom["people_photo"][0];
  $cv = $custom["cv"][0];
  ?>
  
<script src="<?php get_bloginfo('template_url'); ?>/assets/js/custom.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#uploadPhoto').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#people_photo');
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

    <label for="people_photo"><strong>Upload Photo:</strong></label>
    <input type="text" class="widefat" name="people_photo" id="people_photo" value="<?php echo $people_photo; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="uploadPhoto" value="Upload Image" />

</p>

<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#uploadCV').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#cv');
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

    <label for="cv"><strong>Upload CV/Resume:</strong></label>
    <input type="text" class="widefat" name="cv" id="cv" value="<?php echo $cv; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="uploadCV" value="Upload CV/Resume" />

</p>

   <?php
}





// Save meta 
add_action('save_post', 'save_details');
//Save and update function
function save_details(){
  global $post;
 
  update_post_meta($post->ID, "position", $_POST["position"]);
  update_post_meta($post->ID, "degrees", $_POST["degrees"]);
  update_post_meta($post->ID, "expertise", $_POST["expertise"]);
  update_post_meta($post->ID, "phone", $_POST["phone"]);
  update_post_meta($post->ID, "email", $_POST["email"]);
  update_post_meta($post->ID, "office", $_POST["office"]);
  update_post_meta($post->ID, "hours", $_POST["hours"]);
  update_post_meta($post->ID, "website", $_POST["website"]);
  update_post_meta($post->ID, "bio", $_POST["bio"]);
  update_post_meta($post->ID, "research", $_POST["research"]);
  update_post_meta($post->ID, "teaching", $_POST["teaching"]);
  update_post_meta($post->ID, "publications", $_POST["publications"]);
  update_post_meta($post->ID, "extra_tab_title", $_POST["extra_tab_title"]);
  update_post_meta($post->ID, "extra_tab", $_POST["extra_tab"]);
  update_post_meta($post->ID, "people_photo", $_POST["people_photo"]);
  update_post_meta($post->ID, "cv", $_POST["cv"]);


}
	

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


//Configuring Admin Columns - in View all People
add_action("manage_posts_custom_column",  "people_custom_columns");
add_filter("manage_edit-people_columns", "people_edit_columns");
 
function people_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "role" => "Group",
    "position" => "Title/Role",
  );
 
  return $columns;
}
function people_custom_columns($column){
  global $post;
 
  switch ($column) {
  case "role":
      echo get_the_term_list($post->ID, 'Role', '', ', ','');
      break;
    case "position":
      $custom = get_post_custom();
      echo $custom["position"][0];
      break;
    
  }
}
// Initiate flush rewrite rules
register_activation_hook(__FILE__, 'my_rewrite_flush');
//Flush rewrite rules
function my_rewrite_flush() {
  people_directory_plugin();
  flush_rewrite_rules();
}


?>