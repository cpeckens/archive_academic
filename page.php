		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
				<?php
				
					if ($post->post_parent)	{
						$ancestors=get_post_ancestors($post->ID);
						$root=count($ancestors)-1;
						$parent = $ancestors[$root];
					} else {		
						$parent = $post->ID;
					}				
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=2");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> <!--End subnav -->

						<!--End Subpage Navigation code -->
						
				<div id="address"><?php get_sidebar('address-sb'); ?></div>
				</div> <!--End sidebar-left -->
				
		
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<?php if ( get_post_meta($post->ID, 'extra_javascript', true) ) : ?><?php echo get_post_meta($post->ID, 'extra_javascript', true); ?><?php endif; ?>
					
					<div class="entry">
						
						<?php if ( has_post_thumbnail()) { ?> 
							<img src="<?php $image_id = get_post_thumbnail_id();
										$image_color =  $ksasaca_option['ksasaca_select_input'];
										$image_name = "page-$image_color";
										$image_url = wp_get_attachment_image_src($image_id, $image_name, true);
										echo $image_url[0];  ?>" class="<?php echo $image_name; ?>" />
						<?php	} ?>						
						<h2><?php the_title() ?></h2>
						
						<?php the_content() ?>
			
					</div><!--End entry -->
					
					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>