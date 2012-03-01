<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function ksasaca_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'ksasaca_textdomain');
	$sections['select_section'] 	= __('Theme Options', 'ksasaca_textdomain');
	
	return $sections;	
}

/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function ksasaca_options_page_fields() {
	// Text Form Fields section
	// Select Form Fields section
	$options[] = array(
		"section" => "select_section",
		"id"      => KSASACA_SHORTNAME . "_select_input",
		"title"   => __( 'Color Palette', 'ksasaca_textdomain' ),
		"desc"    => __( 'Choose your color palette', 'ksasaca_textdomain' ),
		"type"    => "select",
		"std"    => "blue",
		"choices" => array( "blue", "yellow")
	);
	$options[] = array(
		"section" => "checkbox_section",
		"id"      => KSASACA_SHORTNAME . "_multicheckbox_inputs",
		"title"   => __( 'Multi-Checkbox', 'ksasaca_textdomain' ),
		"desc"    => __( 'Choose necessary modules and content types', 'ksasaca_textdomain' ),
		"type"    => "multi-checkbox",
		"std"     => 'chckbx1',
		"choices" => array( __('People','ksasaca_textdomain') . "|chckbx1", __('Courses','ksasaca_textdomain') . "|chckbx2", __('Bulletin Board','ksasaca_textdomain') . "|chckbx3", __('Profiles and Spotlights','ksasaca_textdomain') . "|chckbx4")	
	);
	return $options;	
}

?>