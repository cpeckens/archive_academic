<?php get_header(); ?>
<!-- Insert them single.php container code below -->
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
				<?php
				
							
					$parent = ksas_get_page_id('directoryindex');;
								
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> <!--End subnav -->
<!--Begin Jump to faculty code -->

<?php if ( has_role( 'faculty' ) ) : ?>				
		<?php 
			$args=array(
	  'post_type' => 'people',
	  'role' => 'faculty',
	  'meta_key' => 'people_alpha',
	  'orderby' => 'meta_value',
	  'order' => 'ASC',
	  'post_status' => 'publish',
	  'posts_per_page' => -1,
	  'caller_get_posts'=> 1
	);
	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {
?>
	<div class="jumpmenu"><form name="jump">
		<select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
		<option>Jump to faculty member</option>
			<?php
			  while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<option value="<?php the_permalink() ?>"><?php the_title(); ?></option>
				<?php

			  endwhile;
			}
			?>
		</select>
	</form>
</div>
<?php
	wp_reset_query();
?>
<?php endif; ?>
	<!--End jump-menu -->	

						<!--End Subpage Navigation code -->
				<div id="address"><?php get_sidebar('address-sb'); ?></div>

				</div> <!--End sidebar-left -->
				

				
		
				<div id="content">
 
 
	<!-- Start loop -->

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					
						<div class="entry">
																				
							<div class="people-info">
							
								<div class="people-picture"><?php if ( get_post_meta($post->ID, 'people_photo', true) ) : ?><img src="<?php echo get_post_meta($post->ID, 'people_photo', true); ?>" /><?php endif; ?></div>
								
								<div class="people-contact"><h2><?php the_title() ?></h2>
								<h3><?php echo get_post_meta($post->ID, 'position', true); ?></h3>
								
								
								<p><?php if ( get_post_meta($post->ID, 'office', true) ) : ?><span class="label">Office:</span> <?php echo get_post_meta($post->ID, 'office', true); ?><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'hours', true) ) : ?><span class="label">Office Hours:</span> <?php echo get_post_meta($post->ID, 'hours', true); ?><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'phone', true) ) : ?><span class="label">Phone:</span> <?php echo get_post_meta($post->ID, 'phone', true); ?><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'email', true) ) : ?><span class="label">Email:</span> <a href="mailto:<?php echo get_post_meta($post->ID, 'email', true); ?>"><?php echo get_post_meta($post->ID, 'email', true); ?></a><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'cv', true) ) : ?><span class="label"><a href="<?php echo get_post_meta($post->ID, 'cv', true); ?>">Curriculum Vitae</a></span> (PDF)<br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'job_abstract', true) ) : ?><span class="label"><a href="<?php echo get_post_meta($post->ID, 'job_abstract', true); ?>">Thesis Abstract</a></span> (PDF)<br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'website', true) ) : ?><a href="<?php echo get_post_meta($post->ID, 'website', true); ?>" target="_blank">View personal website</a><?php endif; ?></p>
								</div>
								
							</div>
								
							<div class="people-tabs">
								<!-- Standard <ul> with class of "tabs" -->
								<ul class="tabs">
								  <!-- Give href an ID value of corresponding "tabs-content" <li>'s -->
								  <?php if ( get_post_meta($post->ID, 'bio', true) ) : ?><li><a class="active" href="#bio">Bio</a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'research', true) ) : ?><li><a href="#research">Research</a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'teaching', true) ) : ?><li><a href="#teaching">Teaching</a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'publications', true) ) : ?><li><a href="#publications">Publications</a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'extra_tab_title', true) ) : ?><li><a href="#extra"><?php echo get_post_meta($post->ID, 'extra_tab_title', true); ?></a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'job_research', true) ) : ?><li><a href="#job_research">Research</a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'job_teaching', true) ) : ?><li><a href="#job_teaching">Teaching</a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'job_extra_tab_title', true) ) : ?><li><a href="#job_extra"><?php echo get_post_meta($post->ID, 'job_extra_tab_title', true); ?></a></li><?php endif; ?>
								  <?php if ( get_post_meta($post->ID, 'references', true) ) : ?><li><a href="#references">References</a></li><?php endif; ?>
								</ul>
								
								<!-- Standard <ul> with class of "tabs-content" -->
								<ul class="tabs-content">
								  <!-- Give ID that matches HREF of above anchors -->
								  <?php if ( get_post_meta($post->ID, 'bio', true) ) : ?><li class="active" id="bio"><?php echo get_post_meta($post->ID, 'bio', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'research', true) ) : ?><li id="research"><?php echo get_post_meta($post->ID, 'research', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'teaching', true) ) : ?><li id="teaching"><?php echo get_post_meta($post->ID, 'teaching', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'publications', true) ) : ?><li id="publications"><?php echo get_post_meta($post->ID, 'publications', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'extra_tab', true) ) : ?><li id="extra"><?php echo get_post_meta($post->ID, 'extra_tab', true); ?></li><?php endif; ?>
								  
								  <?php if ( get_post_meta($post->ID, 'job_research', true) ) : ?><li class="active" id="job_research">
								  <p><strong>Thesis Title:</strong>&nbsp;<?php if ( get_post_meta($post->ID, 'thesis', true) ) : ?><?php echo get_post_meta($post->ID, 'thesis', true); ?><?php endif; ?>&nbsp;<?php if ( get_post_meta($post->ID, 'job_abstract', true) ) : ?>- <a href="<?php echo get_post_meta($post->ID, 'job_abstract', true); ?>">Download Abstract</a> (PDF)<?php endif; ?></p>
								  <p><strong>Fields:</strong>&nbsp;<?php echo get_post_meta($post->ID, 'fields', true); ?></p>
								  <?php echo get_post_meta($post->ID, 'job_research', true); ?></li><?php endif; ?>
								  
								  <?php if ( get_post_meta($post->ID, 'job_teaching', true) ) : ?><li id="job_teaching"><?php echo get_post_meta($post->ID, 'job_teaching', true); ?></li><?php endif; ?>
								  
								  <?php if ( get_post_meta($post->ID, 'job_extra_tab', true) ) : ?><li id="job_extra"><?php echo get_post_meta($post->ID, 'job_extra_tab', true); ?></li><?php endif; ?>
								  
								  <?php if ( get_post_meta($post->ID, 'references', true) ) : ?><li id="references"><?php echo get_post_meta($post->ID, 'references', true); ?></li><?php endif; ?>
								</ul>
							</div>
						
						</div><!--End entry -->
						<!-- NOTE: jQuery that fires the change is in app.js -->
					
					<?php endwhile; // end of the loop. ?>


<!-- Insert themes single.php closing container code below -->

				</div> <!--End content -->		
				
				<div class="clearboth"></div> <!--to have background work properly -->
			
			</div> <!--End main -->
			
		</div> <!--End container-mid -->

<?php get_footer(); ?>