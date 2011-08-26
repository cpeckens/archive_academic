		
	<?php get_header() ?>	
					<!-- Hook up the FlexSlider -->
<script type="text/javascript" charset="utf-8">
  $('.flexslider').flexslider({
      slideshowSpeed: 3000,
      pauseOnHover:true
    });
</script>
	
		<div id="slider-holder">
		
		<div class="flexslider">
		
	    <ul class="slides">
	    	<li class="slide1">
	    		<div class="slide-holder">
	    		<img src="<?php bloginfo('template_url'); ?>/assets/img/home-1.png" />
	    		<div class="flex-caption"><h3>At Johns Hopkins, the study of economics offers students dynamic classroom interactions combined with hands-on experience, including the chance to participate in an annual networking trip to firms on Wall Street</h3>
			<p><a href="/undergraduate" class="button">Find Out More</a></p></div>
			</div>
	    	</li>
	    	
	    	<li class="slide2">
	    	<div class="slide-holder">
	    		<img src="<?php bloginfo('template_url'); ?>/assets/img/home-2.png" />
	    		<div class="flex-caption"><h3>With its world-class faculty, individualized attention, and small classes the doctoral program is the centerpiece of the department.  From complex financial research graduate students in economics are prepared to be leaders in the field.</h3>
			<p><a href="/undergraduate" class="button">Find Out More</a></p></div>
			</div>
	    	</li>
	    	<li class="slide3">
	    	<div class="slide-holder">
	    		<img src="<?php bloginfo('template_url'); ?>/assets/img/home-3.png" />
	    		<div class="flex-caption"><h3>Economics alumni from Johns Hopkins have become business leaders and financial innovators in a variety of places including investment firms, banks, and corporations all over the world.</h3>
			<p><a href="/undergraduate" class="button">Find Out More</a></p></div>
			</div>
	    	</li>
	    	
	    </ul>
	    <div class="clearboth"></div> <!--to have background work properly -->
	  </div>
	
	  </div>


			<div id="container-mid">
			<div id="homepage">
				
				<div id="sidebar-right">
				<h3>Sidebar Right</h3>

				</div> <!--End sidebar-right -->
		
				<div id="blogfeed">
					
					<?php
    					$recentPosts = new WP_Query();
    					$recentPosts->query('showposts=3');
					?>
					
					<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?> <!--Start the loop -->
					
					<div class="snippet">
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( has_post_thumbnail()) { ?> 
						<div class="thumbnail"><img src="<?php $image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,’thumbnail’, true);
										echo $image_url[0];  ?>" align="left" height="75" /></div>
						<?php	} ?>
						
						<?php the_excerpt() ?>
			
					</div><!--End snippet -->
					
					<?php endwhile; ?>
					
					<p><a href="/about/news-archive/page/2/">More News and Announcements</a>
				</div> <!--End blogfeed -->	
				
				
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End homepage -->
			
		</div> <!--End container-mid -->
			


	
	
	<?php get_footer() ?>