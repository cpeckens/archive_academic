	<?php get_header() ?>	
	<?php
	    	// Get any existing copy of our transient data
	    	if ( false === ( $my_slider_query = get_transient( 'ksas_slider_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_slider_query = new WP_Query(array(
	    			'post_type' => 'slider',
	    			'posts_per_page' => '4'));
        	set_transient( 'ksas_slider_query', $my_slider_query, 86400 );
	    	} ?>		
	<!-- Hook up the FlexSlider -->	
	<?php if ($my_slider_query->have_posts()) : ?>
	<div id="slider-holder">
		<div class="flexslider">
	   		<ul class="slides">
				<?php while ($my_slider_query->have_posts()) : $my_slider_query->the_post(); ?>
				<li class="<?php echo get_post_meta($post->ID, 'ecpt_slidecolor', true); ?>">
		   		 	<div class="slide-holder">
		   		 		<a href="<?php echo get_post_meta($post->ID, 'ecpt_urldestination', true); ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_slideimage', true); ?>" /></a>
		   		 		<div class="flex-caption">
		   		 			<h3><?php the_content(); ?></h3>
		   		 			<?php if ( get_post_meta($post->ID, 'ecpt_button', true) ) : ?>
		   						<p><a href="<?php echo get_post_meta($post->ID, 'ecpt_urldestination', true); ?>" class="button">Find Out More</a></p>
		   					<?php endif;?>
		   				</div>
		   			</div>
		   		 </li>
				<?php endwhile; ?>
	   		 </ul>
	    <div class="clearboth"></div> <!--to have background work properly -->
	  </div> <!--End flexslider-->
		<div class="clearboth"></div> <!--to have background work properly -->
	  </div> <!--End slider-holder-->
	  <?php endif;?>
	  	
	    <div id="container-mid">
	    	<div id="homepage">
	    	
	    		<div id="sidebar-right">
	    			<?php get_sidebar('homepage-sb'); ?>
	    		</div> <!--End sidebar-right -->
	    		
	    		<div id="blogfeed">
	    		
	    			<h2>Department <span class="altcolorblack">News and Announcements</span></h2>
	    				
	    				<?php //limit posts to 3 and start the loop
        					$recentPosts = new WP_Query();
        					$recentPosts->query('showposts=6');
	    					while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?> 
	    				
	    			<div class="snippet">
	    			    
	    			    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
	    			    
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    	<div class="thumbnail">
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,'thumbnail', true);
	    			    						echo $image_url[0];  ?>" align="left" height="75" /></a>
	    			    	</div> <!--end thumbnail-->
	    			    <?php	} ?>
	    			    
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    				
	    			<div class="morenews"><p><a href="<?php bloginfo('url'); ?>/about/news-archive/">More News and Announcements &gt;&gt;</a></div>
	    		
	    		</div> <!--End blogfeed -->	
	    		
	    		
	    		<div class="clearboth"></div> <!--to have background work properly -->
	    	</div> <!--End homepage -->
	    		
		</div> <!--End container-mid -->
			
	<?php get_footer() ?>