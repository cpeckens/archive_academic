<?php
$coursedetails_metabox_courses = array( 
	'id' => 'coursedetails',
	'title' => 'Course Details',
	'page' => 'courses',
	'context' => 'normal',
	'priority' => 'default',
	'fields' => $coursedetails_fields = array(

				
				array(
					'name' 			=> 'Number of Credits',
					'desc' 			=> '',
					'id' 			=> 'ecpt_credit',
					'class' 		=> 'ecpt_credit',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Instructor Name',
					'desc' 			=> '',
					'id' 			=> 'ecpt_instructor',
					'class' 		=> 'ecpt_instructor',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Prerequisites',
					'desc' 			=> '',
					'id' 			=> 'ecpt_prereqs',
					'class' 		=> 'ecpt_prereqs',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Course Website',
					'desc' 			=> '',
					'id' 			=> 'ecpt_course_website',
					'class' 		=> 'ecpt_course_website',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Course Times',
					'desc' 			=> '',
					'id' 			=> 'ecpt_course_times',
					'class' 		=> 'ecpt_course_times',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Class Limit',
					'desc' 			=> '',
					'id' 			=> 'ecpt_class_limit',
					'class' 		=> 'ecpt_class_limit',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_coursedetails_meta_box');
function ecpt_add_coursedetails_meta_box() {

	global $coursedetails_metabox_courses;			
		
	add_meta_box($coursedetails_metabox_courses['id'], $coursedetails_metabox_courses['title'], 'ecpt_show_coursedetails_box', 'courses', 'normal', 'default', $coursedetails_metabox_courses);
}

// function to show meta boxes
function ecpt_show_coursedetails_box()	{
	global $post;
	global $coursedetails_metabox_courses;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_coursedetails_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($coursedetails_metabox_courses['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_coursedetails_save');

// Save data from meta box
function ecpt_coursedetails_save($post_id) {
	global $post;
	global $coursedetails_metabox_courses;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_coursedetails_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($coursedetails_metabox_courses['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

$sliderinfo_metabox_slider = array( 
	'id' => 'sliderinfo',
	'title' => 'Slider Info',
	'page' => 'slider',
	'context' => 'normal',
	'priority' => 'default',
	'fields' => $sliderinfo_fields = array(

				
				array(
					'name' 			=> 'Slide Image',
					'desc' 			=> 'Image needs to be 670x360',
					'id' 			=> 'ecpt_slideimage',
					'class' 		=> 'ecpt_slideimage',
					'type' 			=> 'upload',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Slide Color',
					'desc' 			=> 'Choose yellow, blue, green. This is only relevant for the \"Blue\" variation of this theme.',
					'id' 			=> 'ecpt_slidecolor',
					'class' 		=> 'ecpt_slidecolor',
					'type' 			=> 'radio',
					'rich_editor' 	=> 1,			
					'options' => array('blueslide','yellowslide','greenslide'),
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'URL Destination',
					'desc' 			=> 'Enter url of destination page',
					'id' 			=> 'ecpt_urldestination',
					'class' 		=> 'ecpt_urldestination',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Find Out More Button',
					'desc' 			=> 'Add a Find Out More button after the caption',
					'id' 			=> 'ecpt_button',
					'class' 		=> 'ecpt_button',
					'type' 			=> 'checkbox',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_sliderinfo_meta_box');
function ecpt_add_sliderinfo_meta_box() {

	global $sliderinfo_metabox_slider;			
		
	add_meta_box($sliderinfo_metabox_slider['id'], $sliderinfo_metabox_slider['title'], 'ecpt_show_sliderinfo_box', 'slider', 'normal', 'default', $sliderinfo_metabox_slider);
}

// function to show meta boxes
function ecpt_show_sliderinfo_box()	{
	global $post;
	global $sliderinfo_metabox_slider;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_sliderinfo_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($sliderinfo_metabox_slider['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_sliderinfo_save');

// Save data from meta box
function ecpt_sliderinfo_save($post_id) {
	global $post;
	global $sliderinfo_metabox_slider;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_sliderinfo_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($sliderinfo_metabox_slider['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

$personaldetails_metabox_people = array( 
	'id' => 'personaldetails',
	'title' => 'Personal Details',
	'page' => 'people',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => $personaldetails_fields = array(

				
				array(
					'name' 			=> 'Last Name (For Indexing)',
					'desc' 			=> '',
					'id' 			=> 'ecpt_people_alpha',
					'class' 		=> 'ecpt_people_alpha',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Position/Title',
					'desc' 			=> '',
					'id' 			=> 'ecpt_position',
					'class' 		=> 'ecpt_position',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Degrees',
					'desc' 			=> '',
					'id' 			=> 'ecpt_degrees',
					'class' 		=> 'ecpt_degrees',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Expertise/Research Interests',
					'desc' 			=> '',
					'id' 			=> 'ecpt_expertise',
					'class' 		=> 'ecpt_expertise',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Phone Number',
					'desc' 			=> '',
					'id' 			=> 'ecpt_phone',
					'class' 		=> 'ecpt_phone',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Email Address',
					'desc' 			=> '',
					'id' 			=> 'ecpt_email',
					'class' 		=> 'ecpt_email',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Office Location',
					'desc' 			=> '',
					'id' 			=> 'ecpt_office',
					'class' 		=> 'ecpt_office',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Office Hours',
					'desc' 			=> '',
					'id' 			=> 'ecpt_hours',
					'class' 		=> 'ecpt_hours',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Personal Website',
					'desc' 			=> '',
					'id' 			=> 'ecpt_website',
					'class' 		=> 'ecpt_website',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_personaldetails_meta_box');
function ecpt_add_personaldetails_meta_box() {

	global $personaldetails_metabox_people;			
		
	add_meta_box($personaldetails_metabox_people['id'], $personaldetails_metabox_people['title'], 'ecpt_show_personaldetails_box', 'people', 'normal', 'high', $personaldetails_metabox_people);
}

// function to show meta boxes
function ecpt_show_personaldetails_box()	{
	global $post;
	global $personaldetails_metabox_people;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_personaldetails_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($personaldetails_metabox_people['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_personaldetails_save');

// Save data from meta box
function ecpt_personaldetails_save($post_id) {
	global $post;
	global $personaldetails_metabox_people;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_personaldetails_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($personaldetails_metabox_people['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

$facultyinformation_metabox_people = array( 
	'id' => 'facultyinformation',
	'title' => 'Faculty Information',
	'page' => 'people',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => $facultyinformation_fields = array(

				
				array(
					'name' 			=> 'Biography',
					'desc' 			=> '',
					'id' 			=> 'ecpt_bio',
					'class' 		=> 'ecpt_bio',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Research',
					'desc' 			=> '',
					'id' 			=> 'ecpt_research',
					'class' 		=> 'ecpt_research',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Teaching',
					'desc' 			=> '',
					'id' 			=> 'ecpt_teaching',
					'class' 		=> 'ecpt_teaching',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Publications',
					'desc' 			=> '',
					'id' 			=> 'ecpt_publications',
					'class' 		=> 'ecpt_publications',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Extra Tab Title',
					'desc' 			=> '',
					'id' 			=> 'ecpt_extra_tab_title',
					'class' 		=> 'ecpt_extra_tab_title',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Extra Tab Content',
					'desc' 			=> '',
					'id' 			=> 'ecpt_extra_tab',
					'class' 		=> 'ecpt_extra_tab',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_facultyinformation_meta_box');
function ecpt_add_facultyinformation_meta_box() {

	global $facultyinformation_metabox_people;			
		
	add_meta_box($facultyinformation_metabox_people['id'], $facultyinformation_metabox_people['title'], 'ecpt_show_facultyinformation_box', 'people', 'normal', 'high', $facultyinformation_metabox_people);
}

// function to show meta boxes
function ecpt_show_facultyinformation_box()	{
	global $post;
	global $facultyinformation_metabox_people;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_facultyinformation_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($facultyinformation_metabox_people['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_facultyinformation_save');

// Save data from meta box
function ecpt_facultyinformation_save($post_id) {
	global $post;
	global $facultyinformation_metabox_people;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_facultyinformation_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($facultyinformation_metabox_people['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

$uploadsforprofile_metabox_people = array( 
	'id' => 'uploadsforprofile',
	'title' => 'Uploads for Profile',
	'page' => 'people',
	'context' => 'side',
	'priority' => 'default',
	'fields' => $uploadsforprofile_fields = array(

				
				array(
					'name' 			=> 'Profile Photo',
					'desc' 			=> '465x700',
					'id' 			=> 'ecpt_people_photo',
					'class' 		=> 'ecpt_people_photo',
					'type' 			=> 'upload',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Upload CV',
					'desc' 			=> '',
					'id' 			=> 'ecpt_cv',
					'class' 		=> 'ecpt_cv',
					'type' 			=> 'upload',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Upload Abstract (for Job Candidates)',
					'desc' 			=> '',
					'id' 			=> 'ecpt_job_abstract',
					'class' 		=> 'ecpt_job_abstract',
					'type' 			=> 'upload',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_uploadsforprofile_meta_box');
function ecpt_add_uploadsforprofile_meta_box() {

	global $uploadsforprofile_metabox_people;			
		
	add_meta_box($uploadsforprofile_metabox_people['id'], $uploadsforprofile_metabox_people['title'], 'ecpt_show_uploadsforprofile_box', 'people', 'side', 'default', $uploadsforprofile_metabox_people);
}

// function to show meta boxes
function ecpt_show_uploadsforprofile_box()	{
	global $post;
	global $uploadsforprofile_metabox_people;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_uploadsforprofile_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($uploadsforprofile_metabox_people['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_uploadsforprofile_save');

// Save data from meta box
function ecpt_uploadsforprofile_save($post_id) {
	global $post;
	global $uploadsforprofile_metabox_people;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_uploadsforprofile_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($uploadsforprofile_metabox_people['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

$jobcandidatedetails_metabox_people = array( 
	'id' => 'jobcandidatedetails',
	'title' => 'Job Candidate Details',
	'page' => 'people',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => $jobcandidatedetails_fields = array(

				
				array(
					'name' 			=> 'Thesis Title',
					'desc' 			=> '',
					'id' 			=> 'ecpt_thesis',
					'class' 		=> 'ecpt_thesis',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Fields',
					'desc' 			=> '',
					'id' 			=> 'ecpt_fields',
					'class' 		=> 'ecpt_fields',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Main Advisor',
					'desc' 			=> '',
					'id' 			=> 'ecpt_advisor',
					'class' 		=> 'ecpt_advisor',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Research',
					'desc' 			=> '',
					'id' 			=> 'ecpt_job_research',
					'class' 		=> 'ecpt_job_research',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Teaching',
					'desc' 			=> '',
					'id' 			=> 'ecpt_job_teaching',
					'class' 		=> 'ecpt_job_teaching',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'References',
					'desc' 			=> '',
					'id' 			=> 'ecpt_references',
					'class' 		=> 'ecpt_references',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Extra Tab Title',
					'desc' 			=> '',
					'id' 			=> 'ecpt_job_extra_tab_title',
					'class' 		=> 'ecpt_job_extra_tab_title',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,			
					'max' 			=> 0													
				),
															
				array(
					'name' 			=> 'Extra Tab Content',
					'desc' 			=> '',
					'id' 			=> 'ecpt_job_extra_tab',
					'class' 		=> 'ecpt_job_extra_tab',
					'type' 			=> 'textarea',
					'rich_editor' 	=> 1,			
					'max' 			=> 0													
				),
												)
);			
			
add_action('admin_menu', 'ecpt_add_jobcandidatedetails_meta_box');
function ecpt_add_jobcandidatedetails_meta_box() {

	global $jobcandidatedetails_metabox_people;			
		
	add_meta_box($jobcandidatedetails_metabox_people['id'], $jobcandidatedetails_metabox_people['title'], 'ecpt_show_jobcandidatedetails_box', 'people', 'normal', 'low', $jobcandidatedetails_metabox_people);
}

// function to show meta boxes
function ecpt_show_jobcandidatedetails_box()	{
	global $post;
	global $jobcandidatedetails_metabox_people;
	global $ecpt_prefix;
	global $wp_version;
	
	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_jobcandidatedetails_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($jobcandidatedetails_metabox_people['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
				break;
		}
		echo     '<td>',
			'</tr>';
	}
	
	echo '</table>';
}	

add_action('save_post', 'ecpt_jobcandidatedetails_save');

// Save data from meta box
function ecpt_jobcandidatedetails_save($post_id) {
	global $post;
	global $jobcandidatedetails_metabox_people;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['ecpt_jobcandidatedetails_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($jobcandidatedetails_metabox_people['fields'] as $field) {
	
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								

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
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
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
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
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
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', $field['desc'];
				break;
			case 'date':
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" />' . '' . $field['desc'];
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', $field['desc'];
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
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' />&nbsp;', $option;
				}
				echo '<br/>' . $field['desc'];
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />&nbsp;';
				echo $field['desc'];
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';		
				echo '<div style="width: 100%; clear: both;">' . $field['desc'] . '</div>';
				break;
			case 'repeatable' :
				
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
				
				echo $field_html;
				
				break;
			
			case 'repeatable upload' :
			
				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
			
				echo $field_html;
			
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
				if(is_string($new)) {
					$new = esc_attr($data);
				} 
				update_post_meta($post_id, $field['id'], $new);
				
				
			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

								
function ecpt_export_ui_scripts() {

	global $ecpt_options;
?> 
<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			
			if($('.form-table .ecpt_upload_field').length > 0 ) {
				// Media Uploader
				window.formfield = '';

				$('.ecpt_upload_image_button').live('click', function() {
				window.formfield = $('.ecpt_upload_field',$(this).parent());
					tb_show('', 'media-upload.php?type=file&TB_iframe=true');
									return false;
					});

					window.original_send_to_editor = window.send_to_editor;
					window.send_to_editor = function(html) {
						if (window.formfield) {
							imgurl = $('a','<div>'+html+'</div>').attr('href');
							window.formfield.val(imgurl);
							tb_remove();
						}
						else {
							window.original_send_to_editor(html);
						}
						window.formfield = '';
						window.imagefield = false;
					}
			}
			if($('.form-table .ecpt-slider').length > 0 ) {
				$('.ecpt-slider').each(function(){
					var $this = $(this);
					var id = $this.attr('rel');
					var val = $('#' + id).val();
					var max = $('#' + id).attr('rel');
					max = parseInt(max);
					//var step = $('#' + id).closest('input').attr('rel');
					$this.slider({
						value: val,
						max: max,
						step: 1,
						slide: function(event, ui) {
							$('#' + id).val(ui.value);
						}
					});
				});
			}
			
			if($('.form-table .ecpt_datepicker').length > 0 ) {
				var dateFormat = 'mm/dd/yy';
				$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
			}
			
			// add new repeatable field
			$(".ecpt_add_new_field").on('click', function() {					
				var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
				var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
				// get the hidden field that has the name value
				var name_field = $("input.ecpt_repeatable_field_name", ".ecpt_field_type_repeatable:first");
				// set the base of the new field name
				var name = $(name_field).attr("id");
				// set the new field val to blank
				$('input', field).val("");
				
				// set up a count var
				var count = 0;
				$('.ecpt_repeatable_field').each(function() {
					count = count + 1;
				});
				name = name + '[' + count + ']';
				$('input', field).attr("name", name);
				$('input', field).attr("id", name);
				field.insertAfter(fieldLocation, $(this).closest('td'));

				return false;
			});		

			// add new repeatable upload field
			$(".ecpt_add_new_upload_field").on('click', function() {	
				var container = $(this).closest('tr');
				var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
				var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
				// get the hidden field that has the name value
				var name_field = $("input.ecpt_repeatable_upload_field_name", container);
				// set the base of the new field name
				var name = $(name_field).attr("id");
				// set the new field val to blank
				$('input[type="text"]', field).val("");
				
				// set up a count var
				var count = 0;
				$('.ecpt_repeatable_upload_field', container).each(function() {
					count = count + 1;
				});
				name = name + '[' + count + ']';
				$('input', field).attr("name", name);
				$('input', field).attr("id", name);
				field.insertAfter(fieldLocation, $(this).closest('td'));

				return false;
			});
			
			// remove repeatable field
			$('.ecpt_remove_repeatable').on('click', function(e) {
				e.preventDefault();
				var field = $(this).parent();
				$('input', field).val("");
				field.remove();				
				return false;
			});											
													
		});
  </script>
<?php
}

function ecpt_export_datepicker_ui_scripts() {
	global $ecpt_base_dir;
	wp_enqueue_script('jquery-ui.min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', false, '1.8', 'all');
}
function ecpt_export_datepicker_ui_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css', false, '1.8', 'all');
}

// these are for newest versions of WP
add_action('admin_print_scripts-post.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_styles-post.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-edit.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_export_datepicker_ui_styles');

if ((isset($_GET['post']) && (isset($_GET['action']) && $_GET['action'] == 'edit') ) || (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')))
{
	add_action('admin_head', 'ecpt_export_ui_scripts');
}

// converts a time stamp to date string for meta fields
if(!function_exists('ecpt_timestamp_to_date')) {
	function ecpt_timestamp_to_date($date) {
		
		return date('m/d/Y', $date);
	}
}
if(!function_exists('ecpt_format_date')) {
	function ecpt_format_date($date) {

		$date = strtotime($date);
		
		return $date;
	}
}
?>