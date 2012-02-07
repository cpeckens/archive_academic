		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="searchresults">
					
					<h2>Search Results</h2>
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<div class="snippet">
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<small><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_permalink() ?></a></small>
						<?php if ( has_post_thumbnail()) { ?> 
						<div class="thumbnail"><img src="<?php $image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,'thumbnail', true);
										echo $image_url[0];  ?>" align="left" height="75" /></div>
						<?php	} ?>
						
						<?php the_excerpt() ?>
			
					</div><!--End snippet -->
					
					<?php endwhile; ?>
						<div class="pagination"><?php ksas_pagination('«', '»'); ?></div>
					<?php endif; ?>

				
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End searchresults -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>