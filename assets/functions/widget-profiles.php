<?php add_action('widgets_init', 'ksas_register_widgets');
	function ksas_register_widgets() {
		register_widget('Undergrad_Profile_Widget');
	}

?>


 
<?php 
class Undergrad_Profile_Widget extends WP_Widget {

	function Undergrad_Profile_Widget() {
		$widget_ops = array('classname' => 'widget_undergrad_profile', 'description' => __( "Undergrad Student Profile") );
		$this->WP_Widget('profile-widget', 'Undergrad Student Profile', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;                     
	

		global $post; ?>
		<?php $undergrad_profile_query = new WP_Query('post-type=profile&profile_type=undergraduate&orderby=rand&posts_per_page=1'); ?>
					<?php while ($undergrad_profile_query->have_posts()) : $undergrad_profile_query->the_post(); ?>
         <?php // get_the_ID(); ?>
         <?php //$profileid = $post->ID; ?>               
    	<div class="profile_box">
		<a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'profile_photo', true); ?>" /></a>
    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    	<p><?php echo get_post_meta($post->ID, 'pull_quote', true); ?></p>
    	</div>
	
	
	<?php endwhile; ?>



<?php		echo $after_widget;

	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
?>
		
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

}


?>