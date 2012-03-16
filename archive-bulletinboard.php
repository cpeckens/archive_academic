		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
				<?php
				
							
					$parent = ksas_get_page_id('undergraduate');;
								
									
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
					<div class="entry">
					<h2>Bulletin Board</h2>
					</div>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<div class="snippet">
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						
						<?php the_excerpt() ?>
			
					</div><!--End snippet -->
					
					<?php endwhile; ?>
						<div class="pagination"><?php ksas_pagination('«', '»'); ?></div>
					<?php endif; ?>

				
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>