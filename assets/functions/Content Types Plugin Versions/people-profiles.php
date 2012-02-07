<?php
// registration code for profile post type
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
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'profiles', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('profile',$post_type_args);
	}
	add_action('init', 'register_profile_posttype');									

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

$pullquote_metabox_profile = array( 
	'id' => 'pullquote',
	'title' => 'Pull Quote',
	'page' => 'profile',
	'context' => 'normal',
	'priority' => 'default',
	'fields' => $pullquote_fields = array(

				
				array(
					'name' 			=> 'Pull Quote',
					'desc' 			=> '',
					'id' 			=> 'ecpt_pull_quote',
					'class' 		=> 'ecpt_pull_quote',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_pullquote_meta_box');
function ecpt_add_pullquote_meta_box() {

	global $pullquote_metabox_profile;			
		
	add_meta_box($pullquote_metabox_profile['id'], $pullquote_metabox_profile['title'], 'ecpt_show_pullquote_box', 'profile', 'normal', 'default', $pullquote_metabox_profile);
}

// function to show meta boxes
function ecpt_show_pullquote_box()	{
	global $post;
	global $pullquote_metabox_profile;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_pullquote_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($pullquote_metabox_profile['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
				break;
			case 'textarea':
			
				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __($field['desc']);
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea></div>', '', $field['desc'];				
				}
				
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', $field['desc'];
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_pullquote_save');

// Save data from meta box
function ecpt_pullquote_save($post_id) {
	global $post;
	global $pullquote_metabox_profile;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_pullquote_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($pullquote_metabox_profile['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				update_post_meta($post_id, $field['id'], $new);
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

$profileuploads_metabox_profile = array( 
	'id' => 'profileuploads',
	'title' => 'Profile Uploads',
	'page' => 'profile',
	'context' => 'side',
	'priority' => 'high',
	'fields' => $profileuploads_fields = array(

				
				array(
					'name' 			=> 'Upload Profile Photo',
					'desc' 			=> '',
					'id' 			=> 'ecpt_profile_photo',
					'class' 		=> 'ecpt_profile_photo',
					'type' 			=> 'upload',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_profileuploads_meta_box');
function ecpt_add_profileuploads_meta_box() {

	global $profileuploads_metabox_profile;			
		
	add_meta_box($profileuploads_metabox_profile['id'], $profileuploads_metabox_profile['title'], 'ecpt_show_profileuploads_box', 'profile', 'side', 'high', $profileuploads_metabox_profile);
}

// function to show meta boxes
function ecpt_show_profileuploads_box()	{
	global $post;
	global $profileuploads_metabox_profile;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_profileuploads_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($profileuploads_metabox_profile['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
				break;
			case 'textarea':
			
				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __($field['desc']);
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea></div>', '', $field['desc'];				
				}
				
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', $field['desc'];
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_profileuploads_save');

// Save data from meta box
function ecpt_profileuploads_save($post_id) {
	global $post;
	global $profileuploads_metabox_profile;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_profileuploads_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($profileuploads_metabox_profile['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				update_post_meta($post_id, $field['id'], $new);
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
		
?>