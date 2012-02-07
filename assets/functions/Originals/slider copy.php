<?php

add_action("init", "ksas_slider_plugin");

function ksas_slider_plugin() {

//Create labels
$labels = array(
		'name' => _x('Slider', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'Slide'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search slides'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

//Register custom post type

register_post_type('slider', array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true, // UI in admin panel
	'_builtin' => false, // It's a custom post type, not built in!
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array("slug" => "slides"), // Permalinks format
	'query_var' => "slider", // This goes to the WP_Query schema
	'supports' => array('title', 'editor', 'custom-fields'),
	'can_export' => true,
));

}

//Create Meta boxes
// Intiate create meta boxes
add_action("admin_init", "create_slider_meta_boxes");
function create_slider_meta_boxes(){
	add_meta_box("slider_details", "Redirect Destination", "slider_details", "slider", "normal", "high");
	add_meta_box("slider_uploads", "Slider Uploads", "slider_uploads", "slider", "side", "high");
}

//function to create pull quote meta box
function slider_details() {
  global $post;
  $custom = get_post_custom($post->ID);
  $slider_destination = $custom["slider_destination"][0];
  
  ?>
  <div class="meta-group">  
  <div class="meta-box"><strong>Slide Destination URL:</strong><br><input size="30" name="slider_destination" value="<?php echo $slider_destination; ?>"></input></div>
  </div>
    <div class="clear"></div>

  <?php
}

//function to create uploads meta box
function slider_uploads() {
  global $post;
  $custom = get_post_custom($post->ID);
  $slider_photo = $custom["slider_photo"][0];
  $slider_strip = $custom["slider_strip"][0];
  ?>
  
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#uploadPhoto').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#slider_photo');
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

    <label for="slider_photo"><strong>Upload Slider Photo (750px by 420px):</strong></label>
    <input type="text" class="widefat" name="slider_photo" id="slider_photo" value="<?php echo $slider_photo; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="uploadPhoto" value="Upload Image" />

</p>


<script type="text/javascript">

    jQuery(document).ready(function() {

        jQuery('#uploadStrip').each(function(){

            var the_button = jQuery(this);
            var image_input = jQuery('#slider_strip');
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

    <label for="slider_strip"><strong>Upload Slider Strip (240px by 422px):</strong></label>
    <input type="text" class="widefat" name="slider_strip" id="slider_strip" value="<?php echo $slider_strip; ?>" />

    </p>

<p style="text-align: right;">

    <input type="button" name="" class="button-primary autowidth" id="uploadStrip" value="Upload Image" />

</p>

   <?php
}





// Save meta 
add_action('save_post', 'slider_save_details');
//Save and update function
function slider_save_details(){
	if ( 'slider' == get_post_type() ) {  
  global $post;
  update_post_meta($post->ID, "slider_photo", $_POST["slider_photo"]);
  update_post_meta($post->ID, "slider_strip", $_POST["slider_strip"]);
  update_post_meta($post->ID, "slider_destination", $_POST["slider_destination"]);
}
}

// Initiate flush rewrite rules
register_activation_hook(__FILE__, 'slider_rewrite_flush');
//Flush rewrite rules
function slider_rewrite_flush() {
  ksas_slider_plugin();
  flush_rewrite_rules();
}

?>