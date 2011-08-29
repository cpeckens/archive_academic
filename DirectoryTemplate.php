<?php
/*
Template Name: Directory
*/
?>		
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
					
					
					
					
					<?php if(is_page('faculty')) : ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr>
						<td><?php if ( get_post_meta($post->ID, 'people_photo', true) ) : ?><a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'people_photo', true); ?>" /></a><?php endif; ?></td>
						<td><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
							<p><?php if ( get_post_meta($post->ID, 'position', true) ) : ?>  <?php echo get_post_meta($post->ID, 'position', true); ?><?php endif; ?></p>
							<p><?php if ( get_post_meta($post->ID, 'degrees', true) ) : ?>  <?php echo get_post_meta($post->ID, 'degrees', true); ?><?php endif; ?><br>
							<?php if ( get_post_meta($post->ID, 'expertise', true) ) : ?>  <?php echo get_post_meta($post->ID, 'expertise', true); ?><?php endif; ?></p></td>
						<td><p class="contact-info"><?php if ( get_post_meta($post->ID, 'phone', true) ) : ?> <?php echo get_post_meta($post->ID, 'phone', true); ?><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'email', true); ?>"> <?php echo get_post_meta($post->ID, 'email', true); ?></a><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'office', true) ) : ?> <?php echo get_post_meta($post->ID, 'office', true); ?><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'hours', true) ) : ?> <?php echo get_post_meta($post->ID, 'hours', true); ?><?php endif; ?></p></td>
					</tr>
					
					<?php endwhile; ?>
					
					
					
					
					<?php elseif(is_page('job-market-candidates')) :  ?>
					
					<tr>
					<th colspan="2">Name</th>
					<th>Thesis Title</th>
					<th>Fields</th>
					</tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=job-market-candidate&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					
					<tr>
						<td><?php if ( get_post_meta($post->ID, 'people_photo', true) ) : ?><a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'people_photo', true); ?>" /></a><?php endif; ?></td>
						
						<td><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4><?php if ( get_post_meta($post->ID, 'phone', true) ) : ?> <?php echo get_post_meta($post->ID, 'phone', true); ?><br><?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'email', true); ?>"> <?php echo get_post_meta($post->ID, 'email', true); ?></a><?php endif; ?></p></td>
						
						<td><p class="candidates"><?php if ( get_post_meta($post->ID, 'thesis', true) ) : ?><?php echo get_post_meta($post->ID, 'thesis', true); ?><?php endif; ?><?php if ( get_post_meta($post->ID, 'job_abstract', true) ) : ?>&nbsp;<a href="<?php echo get_post_meta($post->ID, 'job_abstract', true); ?>">Download Abstract (PDF)</a><?php endif; ?> </p></td>
						
						<td><p class="candidates"><?php if ( get_post_meta($post->ID, 'fields', true) ) : ?><?php echo get_post_meta($post->ID, 'fields', true); ?><?php endif; ?></td>
							
						
					</tr>
					
					<?php endwhile; ?>
					
					
					
					
					
					<?php elseif(is_page('staff')) :  ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>
					
					
				
				
				
				<?php elseif(is_page('visiting-faculty')) :  ?>
					<tr><!--Insert Header Row --></tr>
					
					<!--Create query -->
					<?php $my_query = new WP_Query('post-type=people&role=faculty&posts_per_page=25'); ?>
					<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					
					<tr><!--Insert Faculty/Person Info--></tr>
					
					<?php endwhile; ?>

					
					
										
					
					
					<?php endif; ?>
					
					
					
					
					
					
					</table>
					</div> <!--end directory-table-->
						<div class="pagination"><?php ksas_pagination('«', '»'); ?></div>
				
				
				
				
				
				


					</div> <!--End entry-->
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>