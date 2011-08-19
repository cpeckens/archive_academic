		
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
							<li class="subnav-head">Also in <span class="highlight"><?php echo get_the_title($parent); ?></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> <!--End subnav -->

						<!--End Subpage Navigation code -->
				</div> <!--End sidebar-left -->
		
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<div class="entry">
						
						<h2><?php the_title() ?></h2>
						
						<?php the_content() ?>
			
					</div><!--End entry -->
					
					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
				</div> <!--End content -->			
			</div> <!--End main -->
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>