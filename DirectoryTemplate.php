		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
				<?php
				
							
					$parent = ksas_get_page_id('people');;
								
									
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
					
					<!--This is the page content: Title and searchbar -->
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					<h2><?php the_title(); ?></h2>
					<?php endwhile; ?>
					<?php endif; ?>
<!--
					<div class="searchbar"><form method=”get” id=”searchform” action=”<?php // bloginfo(‘home’); ?>/people”>
<div><input type=”text” size=”18″ value=” ” name=”s” id=”s” />
<input type=”submit” id=”searchsubmit” value=”Search” class=”btn” />
</div>
</form></div>
-->					




					<div class="directory-table">
					<table>
					
					
					
					
					<?php if(is_page('faculty')){ ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>
					
					
					
					
					
					<?php elseif(is_page('graduate-students')){ ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>
					<?php } elseif ?>
					
					
					
					
					<?php elseif(is_page('job-market-candidates')){ ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>
					
					
					
					
					
					<?php elseif(is_page('staff')){ ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>
					
					
				
				
				
				<?php elseif(is_page('visiting-faculty')){ ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>
					
					
					
					<?php } endif; ?>
					
					
					
					
					
					
					</table>
					</div> <!--end directory-table-->
						<div class="pagination"><?php ksas_pagination('«', '»'); ?></div>
				
				
				
				
				
				


					</div> <!--End entry-->
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>