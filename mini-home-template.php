<?php
/*
Template Name: Mini-Home
*/
?>		
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
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> <!--End subnav -->

						<!--End Subpage Navigation code -->
				</div> <!--End sidebar-left -->
				
		
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<div class="entry">
						
						<?php if ( has_post_thumbnail()) { ?> 
						<img src="<?php $image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,Õpage-imageÕ, true);
										echo $image_url[0];  ?>" />
						<?php	} ?>
						<div class="entry-text">
						<h2><?php the_title() ?></h2>
						
						<?php the_content() ?>
						<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
						</div> <!--End entry-text -->
						
						<div id="sidebar-right">
						<?php if(is_page('undergraduate')) : ?>
							<?php get_sidebar('undergrad-sb'); ?>
						<?php elseif(is_page('graduate')) :  ?>
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('graduate-sb') ) : ?>
							<?php endif; ?>
						<?php endif; ?>
						</div>
			
					</div><!--End entry -->
					
					
				
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>