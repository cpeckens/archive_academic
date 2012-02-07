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
		"choices" => array( "blue", "yellow", "green")
	);
	
	return $options;	
}

?>