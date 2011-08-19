	<?php get_header() ?>
	
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
					<?php
						if(!$post->post_parent){
							// will display the subpages of this top level page
							$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1"); 
						}else{
							// diplays only the subpages of parent level
							$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1");
						}

						if ($children) { ?>
							<div id="subnav">
								<ul>
								<?php echo $children; ?>
								</ul>
							</div>
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