		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
				<?php
				
						if ( ksasaca_in_taxonomy( 'coursetype', 'undergraduate-course' ) ) : 
					 $parent = ksas_get_page_id('undergraduate');
				elseif( ksasaca_in_taxonomy( 'coursetype', 'graduate-course' ) ) :
					 $parent = ksas_get_page_id('graduate');
				endif;				
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
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
					
					<div class="entry">
						
						
						<h3><?php the_title() ?></h3>
						
						<?php the_content()?>
								<?php if ( get_post_meta($post->ID, 'ecpt_prereqs', true) ) : ?><p><span class="label">Prerequisites:</span> <?php echo get_post_meta($post->ID, 'ecpt_prereqs', true); ?></p><?php endif; ?>
								<p><?php if ( get_post_meta($post->ID, 'ecpt_instructor', true) ) : ?><span class="label">Instructor:</span> <?php echo get_post_meta($post->ID, 'ecpt_instructor', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_times', true) ) : ?><span class="label">Course Times:</span> <?php echo get_post_meta($post->ID, 'ecpt_course_times', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_limit', true) ) : ?><span class="label">Course Limit:</span> <?php echo get_post_meta($post->ID, 'ecpt_course_limit', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_website', true) ) : ?><a href="<?php echo get_post_meta($post->ID, 'ecpt_course_website', true); ?>" target="_blank">View course website/syllabus</a><?php endif; ?>
			
					</div><!--End entry -->
					
					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>