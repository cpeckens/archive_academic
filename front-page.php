		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="homepage">
				
				
		
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
										echo $image_url[0];  ?>" align="left" /></div>
						<?php	} ?>
						
						<?php the_excerpt() ?>
			
					</div><!--End snippet -->
					
					<?php endwhile; ?>
					
					<p><a href="/about/news-archive/">More News and Announcements</a></
				<div class="clearboth"></div>
				</div> <!--End blogfeed -->	
				
				<div id="sidebar-right">
				<h3>Sidebar Right</h3>

				</div> <!--End sidebar-right -->	
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End homepage -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>