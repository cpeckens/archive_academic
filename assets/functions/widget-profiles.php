<?php 

//Register all of the widgets
add_action('widgets_init', 'ksas_register_widgets');
	function ksas_register_widgets() {
		register_widget('Undergrad_Profile_Widget');
		register_widget('Graduate_Profile_Widget');
		register_widget('job_candidate_Widget');
		register_widget('Spotlight_Widget');
		register_widget('Bulletin_Board_Widget');
	}


// Define undergrad student profile widget
class Undergrad_Profile_Widget extends WP_Widget {

	function Undergrad_Profile_Widget() {
		$widget_ops = array('classname' => 'widget_undergrad_profile', 'description' => __( "Undergrad Student Profile") );
		$this->WP_Widget('undergrad-profile-widget', 'Undergrad Student Profile', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;                     
	

		global $post; ?>
		<?php $undergrad_profile_query = new WP_Query('post-type=profiles&profile_type=undergraduate&orderby=rand&posts_per_page=1'); ?>
					<?php while ($undergrad_profile_query->have_posts()) : $undergrad_profile_query->the_post(); ?>           
    	<div class="profile_box">
    	<div class="spotlight"></div>
		<a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_profile_photo', true); ?>" /></a>
    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    	<p><?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></p>
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
<?php 

// Define graduate student profile widget
class Graduate_Profile_Widget extends WP_Widget {

	function Graduate_Profile_Widget() {
		$widget_ops = array('classname' => 'widget_graduate_profile', 'description' => __( "Graduate Student Profile") );
		$this->WP_Widget('grad-profile-widget', 'Graduate Student Profile', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;                     
	

		global $post; ?>
		<?php $graduate_profile_query = new WP_Query('post-type=profile&profile_type=graduate&orderby=rand&posts_per_page=1'); ?>
					<?php while ($graduate_profile_query->have_posts()) : $graduate_profile_query->the_post(); ?>
         <?php // get_the_ID(); ?>
         <?php //$profileid = $post->ID; ?>               
    	<div class="profile_box">
    	<div class="spotlight"></div>
		<a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_profile_photo', true); ?>" /></a>
    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    	<p><?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></p>
    	</div>
	
	
	<?php endwhile; ?>



<?php echo $after_widget;

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
<?php 
// Define bulletin board widget
class Bulletin_Board_Widget extends WP_Widget {

	function Bulletin_Board_Widget() {
		$widget_ops = array('classname' => 'widget_bulletin_board', 'description' => __( "Bulletin Board Widget") );
		$this->WP_Widget('bulletin-board-widget', 'Bulletin Board Widget', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;                     
	

		global $post; ?>
		<?php global $wp_query;
			$bulletin_board_query = new WP_Query("post_type=bulletinboard&post_status=publish&posts_per_page=5"); ?>
<div class="bulletinboard">
    	<h3><img src="/wp-content/themes/academic/assets/img/arrow.png" width="25" height="25" />Bulletin Board</h3>
					<?php while ($bulletin_board_query->have_posts()) : $bulletin_board_query->the_post(); ?>
    	
    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    	<?php the_excerpt(); ?>
    	
	
	
	<?php endwhile; ?>
	<p align="right"><a href="<?php bloginfo('url'); ?>/bulletin_board">View all &gt;&gt;</a></p>
</div>


<?php echo $after_widget;

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
<?php 

// Define job candidate widget
class job_candidate_Widget extends WP_Widget {

	function job_candidate_Widget() {
		$widget_ops = array('classname' => 'widget_job_candidate', 'description' => __( "Job Candidate Profile") );
		$this->WP_Widget('job-candidate-widget', 'Job Candidate Profile', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;                     
	

		global $post; ?>
		<?php $job_candidate_query = new WP_Query('post-type=people&role=job-market-candidate&orderby=rand&posts_per_page=1'); ?>
					<?php while ($job_candidate_query->have_posts()) : $job_candidate_query->the_post(); ?>            
    	<div class="profile_box">
    	<div class="jobmarket"></div>
		<a href="<?php bloginfo('url'); ?>/directoryindex/job-market/"><img src="<?php echo get_post_meta($post->ID, 'ecpt_people_photo', true); ?>" /></a>
    	<h4><a href="<?php bloginfo('url'); ?>/directoryindex/job-market/"><?php the_title(); ?></a></h4>
    	<p><strong>Thesis:</strong> <?php echo get_post_meta($post->ID, 'ecpt_thesis', true); ?></p>
    	<p><a href="<?php bloginfo('url'); ?>/directoryindex/job-market/">Click here</a> to view all of our 2011-2012 job market candidates.</p>
    	</div>
	
	
	<?php endwhile; ?>

<?php echo $after_widget;

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



// Define graduate student profile widget
class Spotlight_Widget extends WP_Widget {

	function Spotlight_Widget() {
		$widget_ops = array('classname' => 'widget_spotlight', 'description' => __( "Spotlight Widget") );
		$this->WP_Widget('spotlight-widget', 'Spotlight Widget', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;                     
	

		global $post; ?>
		<?php $spotlight_query = new WP_Query('post-type=profile&profile_type=spotlight&orderby=rand&posts_per_page=1'); ?>
					<?php while ($spotlight_query->have_posts()) : $spotlight_query->the_post(); ?>
         <?php // get_the_ID(); ?>
         <?php //$profileid = $post->ID; ?>               
    	<div class="profile_box">
    	<div class="spotlight"></div>
		<a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_profile_photo', true); ?>" /></a>
    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    	<p><?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></p>
    	</div>
	
	
	<?php endwhile; ?>



<?php echo $after_widget;

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