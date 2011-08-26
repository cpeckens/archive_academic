<?php get_header(); ?>

<!-- Insert them single.php container code below -->
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
			<?php
			
					 $parent = ksas_get_page_id('people');
								
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo home_url(); ?>/people">People</a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> <!--End subnav -->

						<!--End Subpage Navigation code -->
				</div> <!--End sidebar-left -->
				
		
				<div id="content">
 
 
	<!-- Start loop -->

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					
						<div class="entry">
							
							<div class="people-info">
							
								<?php if ( get_post_meta($post->ID, 'people_photo', true) ) : ?><img src="<?php echo get_post_meta($post->ID, 'people_photo', true); ?>" /><?php endif; ?>
								
								<h2><?php the_title() ?></h2>
								<h3><?php echo get_post_meta($post->ID, 'position', true); ?></h3>
								
								
								<p><?php if ( get_post_meta($post->ID, 'office', true) ) : ?><span class="label">Office:</span> <?php echo get_post_meta($post->ID, 'office', true); ?><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'hours', true) ) : ?><span class="label">Office Hours:</span> <?php echo get_post_meta($post->ID, 'hours', true); ?><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'phone', true) ) : ?><span class="label">Phone:</span> <?php echo get_post_meta($post->ID, 'phone', true); ?><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'email', true) ) : ?><span class="label">Email:</span> <a href="mailto:<?php echo get_post_meta($post->ID, 'email', true); ?>"><?php echo get_post_meta($post->ID, 'email', true); ?></a><br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'cv', true) ) : ?><span class="label"><a href="<?php echo get_post_meta($post->ID, 'cv', true); ?>">Curriculum Vitae</a></span> (PDF)<br><?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'website', true) ) : ?><a href="<?php echo get_post_meta($post->ID, 'website', true); ?>" target="_blank">View personal website</a><?php endif; ?></p>
								
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
								</ul>
								
								<!-- Standard <ul> with class of "tabs-content" -->
								<ul class="tabs-content">
								  <!-- Give ID that matches HREF+Tab of above anchors -->
								  <?php if ( get_post_meta($post->ID, 'bio', true) ) : ?><li class="active" id="bioTab"><?php echo get_post_meta($post->ID, 'bio', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'research', true) ) : ?><li id="researchTab"><?php echo get_post_meta($post->ID, 'research', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'teaching', true) ) : ?><li id="teachingTab"><?php echo get_post_meta($post->ID, 'teaching', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'publications', true) ) : ?><li id="publicationsTab"><?php echo get_post_meta($post->ID, 'publications', true); ?></li><?php endif; ?>
								
								  <?php if ( get_post_meta($post->ID, 'extra_tab', true) ) : ?><li id="extraTab"><?php echo get_post_meta($post->ID, 'extra_tab', true); ?></li><?php endif; ?>
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