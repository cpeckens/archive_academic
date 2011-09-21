	<?php get_header() ?>	
	
	<!-- Hook up the FlexSlider -->
	<script type="text/javascript">
	var $j = jQuery.noConflict();
		$j(window).load(function() {
			$j('.flexslider').flexslider();
		});
	</script>
	
	<div id="slider-holder">
		
		<div class="flexslider">
	   		 <ul class="slides">
	   		 	<li class="slide1">
	   		 		<div class="slide-holder">
	   		 		<a href="/economics/graduate"><img src="<?php bloginfo('template_url'); ?>/assets/img/home-1.png" /></a>
	   		 		<div class="flex-caption"><h3>Featuring a world-class faculty and individualized attention, the doctoral program is the centerpiece of the department. Students share academic and collegial connections with their professors, who guide them through thought-provoking research and an intense curriculum. </h3>
	   				<p><a href="/economics/graduate" class="button">Find Out More</a></p></div>
	   				</div>
	   		 	</li>
	   		 	<li class="slide3">
	   		 	<div class="slide-holder">
	   		 		<a href="/economics/undergraduate"><img src="<?php bloginfo('template_url'); ?>/assets/img/home-3.png" /></a>
	   		 		<div class="flex-caption"><h3>At Johns Hopkins, the undergraduate study of economics offers students dynamic classroom interactions that explore important economic problems and provide the tools needed to address them&mdash;in theory and in practice. </h3>
	   				<p><a href="/economics/undergraduate" class="button">Find Out More</a></p></div>
	   				</div>
	   		 	</li>
	   		 	<li class="slide2">
	   		 	<div class="slide-holder">
	   		 		<a href="/economics/graduate/recent-placements"><img src="<?php bloginfo('template_url'); ?>/assets/img/home-2.png" /></a>
	   		 		<div class="flex-caption"><h3>Department of Economics alumni are leaders in their fields. Students are frequently appointed to esteemed academic institutions, think tanks, government research positions, and investment banks around the world. </h3>
	   				<p><a href="/economics/graduate/recent-placements" class="button">Find Out More</a></p></div>
	   				</div>
	   		 	</li>
	   		 </ul>
	    <div class="clearboth"></div> <!--to have background work properly -->
	  </div> <!--End flexslider-->
		<div class="clearboth"></div> <!--to have background work properly -->
	  </div> <!--End slider-holder-->	

	    <div id="container-mid">
	    	<div id="homepage">
	    	
	    		<div id="sidebar-right">
	    			<?php get_sidebar('homepage-sb'); ?>
	    		</div> <!--End sidebar-right -->
	    		
	    		<div id="blogfeed">
	    		
	    			<h2>Department <span class="altcolorblack">News and Announcements</span></h2>
	    				
	    				<?php //limit posts to 3 and start the loop
        					$recentPosts = new WP_Query();
        					$recentPosts->query('showposts=3');
	    					while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?> 
	    				
	    			<div class="snippet">
	    			    
	    			    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
	    			    
	    			    <?php if ( has_post_thumbnail()) { ?> 
	    			    	<div class="thumbnail">
	    			    		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    		<img src="<?php $image_id = get_post_thumbnail_id();
	    			    						$image_url = wp_get_attachment_image_src($image_id,’thumbnail’, true);
	    			    						echo $image_url[0];  ?>" align="left" height="75" /></a>
	    			    	</div> <!--end thumbnail-->
	    			    <?php	} ?>
	    			    
	    			    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_excerpt() ?></a>
	    			
	    			</div><!--End snippet -->
	    				
	    			<?php endwhile; //End loop ?>
	    				
	    			<div class="morenews"><p><a href="/economics/about/news-archive/">More News and Announcements &gt;&gt;</a></div>
	    		
	    		</div> <!--End blogfeed -->	
	    		
	    		
	    		<div class="clearboth"></div> <!--to have background work properly -->
	    	</div> <!--End homepage -->
	    		
		</div> <!--End container-mid -->
			
	<?php get_footer() ?>