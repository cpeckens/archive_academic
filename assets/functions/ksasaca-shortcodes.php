<?php
//******************Accordion Shortcode************************//
function acc_title_shortcode( $attr, $content = null ) {
  return '<h3 class="acc_trigger"><a href="#">' . $content . '</a></h3>';
}
add_shortcode('acc-title', 'acc_title_shortcode'); 

function acc_content_shortcode( $attr, $content = null ) {
  return '<div class="acc_container">' . $content . '</div>';
}
add_shortcode('acc-content', 'acc_content_shortcode'); 

//******************Read More/Read Less Shortcode************************//

function readmore_title_shortcode( $attr, $content = null ) {
  return '<div class="wysiwyg-more-less"><div class="wysiwyg-more-less-top"><h4>' . $content . '<span class="readmore">&nbsp;[<a class="wysiwyg-read-more-link" href="#">Read More</a>]</span></h4></div>';
}
add_shortcode('readmore-title', 'readmore_title_shortcode'); 

function readmore_content_shortcode( $attr, $content = null ) {
  return '<div class="wysiwyg-more-less-toggle">' . $content . '</div></div>';
}
add_shortcode('readmore-content', 'readmore_content_shortcode'); 


//******************Create WYSIWYG Buttons for Shortcodes************************//

function add_shortcode_buttons() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin');
     add_filter('mce_buttons', 'register_buttons');
   }
}

function register_buttons($buttons) {
   array_push($buttons, "acc-title", "acc-content", "readmore-title", "readmore-content");
   return $buttons;
}

function add_plugin($plugin_array) {
   $plugin_array[$buttons] = get_bloginfo('template_url').'/assets/js/ksasaca_shortcodes.js';
   return $plugin_array;
}

 add_action('init', 'add_shortcode_buttons');
?>