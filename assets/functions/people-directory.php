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
	'supports' => array('title'),
	'can_export' => true,
));

//add taxonomies for Department and Role (faculty, staff, graduate student, etc.)
register_taxonomy("Role", array("people"), array("hierarchical" => true, "label" => "Roles", "singular_label" => "Role", "rewrite" => true));
register_taxonomy("Department", array("people"), array("hierarchical" => true, "label" => "Departments", "singular_label" => "Department", "rewrite" => true));
}

//Create Meta boxes
// Intiate create meta boxes
add_action("admin_init", "people_create_meta_boxes");
function people_create_meta_boxes(){
  add_meta_box("people_details", "Personal Details", "people_details", "people", "normal", "low");
  add_meta_box("job_candidate", "Job Candidate Details", "job_candidate", "people", "normal", "low");
  add_meta_box("people_uploads", "Uploads", "people_uploads", "people", "side", "high");
}

//Style and label meta boxes	
function people_details() {
  global $post;
  $custom = get_post_custom($post->ID);
  $people_alpha = $custom["people_alpha"][0];
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
  <script language="javascript" type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas"
});
</script>
  <div class="meta-group">  
  <div class="meta-box"><strong>Title/Position:</strong><br><input size="30" name="position" value="<?php echo $position; ?>"></input></div>
    <div class="meta-box"><strong>Last Name (For Indexing):</strong><br><input size="30" name="people_alpha" value="<?php echo $people_alpha; ?>"></input></div>
<div class="clear"></div>
  <div class="meta-box"><strong>Degrees:</strong><br>
  <input cols="30" rows="3" name="degrees" value="<?php echo $degrees; ?>"></input></div>
  <div class="meta-box"><strong>Expertise/Research Interests:</strong><br>
  <input cols="30" rows="3" name="expertise" value="<?php echo $expertise; ?>"></input></div>
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
    <h3>Additional Details (For Faculty)</h3>
    <div class="divider"></div>
      <div class="meta-group">  
    <div class="meta-box meta-box-large"><strong>Bio:</strong><br><textarea name="bio"><?php echo $bio; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Research:</strong><br>&nbsp;<textarea name="research"><?php echo $research; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Teaching:</strong><br>&nbsp;<textarea name="teaching"><?php echo $teaching; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Publications:</strong><br>&nbsp;<textarea name="publications"><?php echo $publications; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box"><strong>Extra Tab Title:</strong><br>&nbsp;<input size="30" name="extra_tab_title" value="<?php echo $extra_tab_title; ?>"></input></div>
    <div class="meta-box meta-box-large"><strong>Extra Tab Content:</strong><br>&nbsp;<textarea name="extra_tab"><?php echo $extra_tab; ?></textarea></div>
    </div>
    <div class="clear"></div>
	<div class="clear"></div>
  <?php
}
	


function people_uploads() {
  global $post;
  $custom = get_post_custom($post->ID);
  $people_photo = $custom["people_photo"][0];
  $cv = $custom["cv"][0];
  $job_abstract = $custom["job_abstract"][0];
  ?>
  
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>

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

<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#upload_job_abstract').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#job_abstract');
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

    <label for="job_abstract"><strong>Upload Abstract (for Job Candidates):</strong></label>
    <input type="text" class="widefat" name="job_abstract" id="job_abstract" value="<?php echo $job_abstract; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="upload_job_abstract" value="Upload Abstract" />

</p>

   <?php
}


function job_candidate() {
  global $post;
  $custom = get_post_custom($post->ID);
  $thesis = $custom["thesis"][0];
  $fields = $custom["fields"][0];
  $job_research = $custom["job_research"][0];
  $job_teaching = $custom["job_teaching"][0];
  $references = $custom["references"][0];
  $job_extra_tab_title = $custom["job_extra_tab_title"][0];
  $job_extra_tab = $custom["job_extra_tab"][0];

  ?>
  
<div class="clear"></div>


    <div class="meta-box"><strong>Thesis Title:</strong><br>
  <input cols="50" rows="3" name="thesis" value="<?php echo $thesis; ?>"></input></div>
  <div class="meta-box"><strong>Fields:</strong><br>
  <input cols="50" rows="3" name="fields" value="<?php echo $fields; ?>"></input></div>
  </div>
      <div class="meta-group">  
    <div class="meta-box meta-box-large"><strong>Research:</strong><br><textarea name="job_research"><?php echo $job_research; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>Teaching:</strong><br>&nbsp;<textarea name="job_teaching"><?php echo $job_teaching; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box meta-box-large"><strong>References:</strong><br>&nbsp;<textarea name="references"><?php echo $references; ?></textarea></div>
    <div class="divider"></div>
    <div class="meta-box"><strong>Extra Tab Title:</strong><br>&nbsp;<input size="30" name="job_extra_tab_title" value="<?php echo $job_extra_tab_title; ?>"></input></div>
    <div class="meta-box meta-box-large"><strong>Extra Tab Content:</strong><br>&nbsp;<textarea name="job_extra_tab"><?php echo $job_extra_tab; ?></textarea></div>
    </div>
    <div class="clear"></div>
    <div class="clear"></div>

  <?php
}




// Save meta 
add_action('save_post', 'people_save_details');
//Save and update function
function people_save_details(){
	if ( 'people' == get_post_type() ) {  
  global $post;
 
  update_post_meta($post->ID, "people_alpha", $_POST["people_alpha"]);  
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
  update_post_meta($post->ID, "thesis", $_POST["thesis"]);
  update_post_meta($post->ID, "fields", $_POST["fields"]);
  update_post_meta($post->ID, "job_research", $_POST["job_research"]);
  update_post_meta($post->ID, "job_teaching", $_POST["job_teaching"]);
  update_post_meta($post->ID, "references", $_POST["references"]);
  update_post_meta($post->ID, "job_extra_tab_title", $_POST["job_extra_tab_title"]);
  update_post_meta($post->ID, "job_extra_tab", $_POST["job_extra_tab"]);
  update_post_meta($post->ID, "job_abstract", $_POST["job_abstract"]);


}
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
register_activation_hook(__FILE__, 'people_rewrite_flush');
//Flush rewrite rules
function people_rewrite_flush() {
  people_directory_plugin();
  flush_rewrite_rules();
}


?>