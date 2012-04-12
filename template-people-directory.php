<?php
/*
Template Name: Directory
*/
?>		
	<?php get_header() ?>	
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				<!--Subpage navigation -->
				<?php
				
					$parent = ksas_get_page_id('directoryindex');;
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> 
				<!--End Subpage Navigation code -->
				<div id="address"><?php get_sidebar('address-sb'); ?></div>
				</div> <!--End sidebar-left -->
				
				<div id="content">
					<div class="entry">
					
					<!--This is the page content: Title -->
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					<h2><?php the_title(); ?></h2>
					<?php endwhile; ?>
					<?php endif; ?>
					<div class="directory-table">
					<table>
					
					<?php if(is_page('faculty')) : ?>
					
					<!--Create Faculty query -->
					<?php 	    	// Get any existing copy of our transient data
	    	if ( false === ( $my_faculty_query = get_transient( 'ksas_faculty_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_faculty_query = new WP_Query(array(
					'post-type' => 'people',
					'role' => 'faculty',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '25'));
        	set_transient( 'ksas_faculty_query', $my_faculty_query, 86400 );
	    	} ?>
					
					<?php while ($my_faculty_query->have_posts()) : $my_faculty_query->the_post(); ?>
					
					<tr>
						<td><?php if ( get_post_meta($post->ID, 'ecpt_people_photo', true) ) : ?><a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_people_photo', true); ?>" /></a><?php endif; ?></td>
						<td><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
							<p><?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_position', true); ?><?php endif; ?></p>
							<p><?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?><?php endif; ?><br>
							<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?><?php endif; ?></p></td>
						<td><p class="contact-info"><?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?><br><?php endif; ?>
							</p></td>
					</tr>
					
					<?php endwhile; ?>
					<?php endif; ?>
					<!--Create Emeriti query -->
					<?php if(is_page('faculty')) : ?>
					<?php // Get any existing copy of our transient data
	    	if ( false === ( $my_emeriti_query = get_transient( 'ksas_emeriti_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_emeriti_query = new WP_Query(array(
					'post-type' => 'people',
					'role' => 'professor-emeriti',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '25'));
        	set_transient( 'ksas_emeriti_query', $my_emeriti_query, 86400 );
	    	} ?>
					<?php if ($my_emeriti_query->have_posts()) : ?>
					</table>
					<h2>Professor Emeriti</h2>
					<table>
					<?php endif; ?>
					
					<?php // Get any existing copy of our transient data
	    	if ( false === ( $my_emeriti_query = get_transient( 'ksas_emeriti_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_emeriti_query = new WP_Query(array(
					'post-type' => 'people',
					'role' => 'professor-emeriti',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '25'));
        	set_transient( 'ksas_emeriti_query', $my_emeriti_query, 86400 );
	    	} ?>
					<?php while ($my_emeriti_query->have_posts()) : $my_emeriti_query->the_post(); ?>
					
					<tr>
						<td><?php if ( get_post_meta($post->ID, 'ecpt_people_photo', true) ) : ?><a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_people_photo', true); ?>" /></a><?php endif; ?></td>
						<td><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
							<p><?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_position', true); ?><?php endif; ?></p>
							<p><?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?><?php endif; ?><br>
							<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?><?php endif; ?></p></td>
						<td><p class="contact-info"><?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a><br><?php endif; ?>
							<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?><br><?php endif; ?>
							</p></td>
					</tr>
					
					<?php endwhile; ?>
					<?php endif; ?>
					<!--Create Job Market query -->
					<?php if(is_page('job-market-candidates')) :  ?>
					
					<tr>
					<th colspan="2">Name</th>
					<th>Thesis Title</th>
					<th>Fields</th>
					</tr>
					
					<!--Create query -->
					<?php // Get any existing copy of our transient data
	    	if ( false === ( $my_candidate_query = get_transient( 'ksas_candidate_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_candidate_query = new WP_Query(array(
					'post-type' => 'people',
					'role' => 'job-market-candidate',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '25'));
        	set_transient( 'ksas_candidate_query', $my_candidate_query, 86400 );
	    	} ?>
					<?php while ($my_candidate_query->have_posts()) : $my_candidate_query->the_post(); ?>
					
					
					<tr>
						<td><?php if ( get_post_meta($post->ID, 'ecpt_people_photo', true) ) : ?><a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_people_photo', true); ?>" /></a><?php endif; ?></td>
						
						<td><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4><?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><br><?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a><?php endif; ?></p></td>
						
						<td><p class="candidates"><?php if ( get_post_meta($post->ID, 'ecpt_thesis', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_thesis', true); ?><?php endif; ?><?php if ( get_post_meta($post->ID, 'ecpt_job_abstract', true) ) : ?>&nbsp;- <a href="<?php echo get_post_meta($post->ID, 'ecpt_job_abstract', true); ?>">Download Abstract (PDF)</a><?php endif; ?> </p></td>
						
						<td><p class="candidates"><?php if ( get_post_meta($post->ID, 'ecpt_fields', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_fields', true); ?><?php endif; ?></td>
							
						
					</tr>
					
					<?php endwhile; ?>
					<!--Create Staff query -->					
					<?php elseif(is_page('staff')) :  ?>
					<tr>
					<th>Name</th>
					<th>Title</th>
					<th>Office</th>
					<th>Phone</th>
					<th>Email</th></tr>
					
					<!--Create query -->
					<?php // Get any existing copy of our transient data
	    	if ( false === ( $my_staff_query = get_transient( 'ksas_staff_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_staff_query = new WP_Query(array(
					'post-type' => 'people',
					'role' => 'staff',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '25'));
        	set_transient( 'ksas_staff_query', $my_staff_query, 86400 );
	    	} ?>
					<?php while ($my_staff_query->have_posts()) : $my_staff_query->the_post(); ?>
					<div class="staff">
					<tr>
					<td><?php the_title() ?></td>
					<td><?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_position', true); ?><?php endif; ?></td>
					<td><?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?><?php endif; ?></td>
					<td><?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><?php endif; ?></td>
					<td><?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a><?php endif; ?></td>
					</tr>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					</table>
					</div> <!--end directory-table-->
						<div class="pagination"><?php ksas_pagination('«', '»'); ?></div>
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					<?php the_content(); ?>
					<?php endwhile; ?>
					<?php endif; ?>
					
					</div> <!--End entry-->
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>