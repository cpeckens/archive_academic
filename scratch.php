
  <?php
//if the post has a parent
if($post->post_parent){
  //collect ancestor pages
  $relations = get_post_ancestors($post->ID);
function get_top_page 
($relations->post_parent) {
	$toplevel= get_post_ancestors($relations); }
  
  
  <?php
  if($post->post_parent)
  $leftnav = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
  else
  
  
  
  
  
  <?php
if(!$post->post_parent){
	// will display the subpages of this top level page
	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1"); wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
}else{
	// diplays only the subpages of parent level
	//$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
	
	if($post->ancestors)
	{
		// now you can get the the top ID of this page
		// wp is putting the ids DESC, thats why the top level ID is the last one
		$ancestors = end($post->ancestors);
		$children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0&depth=1"); wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
		// you will always get the whole subpages list
	}
}

if ($children) { ?>
	<ul>
		<?php echo $children; ?>
	</ul>
<?php } ?>




<?php
//if the post has a parent
if($post->post_parent){
  //collect ancestor pages
  $relations = get_post_ancestors($post->ID);
  }
  //add current post to pages
  array_push($relations, $post->ID);
  //get comma delimited list of children and parents and self
  $relations_string = implode(",",$relations);
  //use include to list only the collected pages. 
  $sidelinks = wp_list_pages("title_li=&echo=0&include=".$relations_string);
}else{
  // display only main level and children
  $sidelinks = wp_list_pages("title_li=&echo=0&depth=1&child_of=".$post->ID);
}

if ($sidelinks) { ?>
  <h2><?php the_title(); ?></h2>
  <ul>
    <?php//links in <li> tags
    echo $sidelinks; ?>
  </ul>         
<?php } ?>


<?php
//if the post has a parent
if($post->post_parent){
  //collect ancestor pages
  $relations = get_post_ancestors($post->ID);
  
  //add current post to pages
  array_push($relations, $post->ID);
  //get comma delimited list of children and parents and self
  $relations_string = implode(",",$relations);
  
  $sidelinks = wp_list_pages("title_li=&echo=0&include=".$relations_string);
  
  ?>
  
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
	
<div class="wysiwyg-more-less">
<div class="wysiwyg-more-less-top">
<h4>Header Bane <span class="readmore">&nbsp;[<a class="wysiwyg-read-more-link" href="#">Read More</a>]</span></h4>
</div>
<div class="wysiwyg-more-less-toggle">
<p>Amrita Ibrahim is a Ph.D. candidate at the Department of Anthropology at Johns Hopkins University. Her research interests span themes in the anthropology of media, visual anthropology, the anthropology of religion, and gender and sexuality, with a specific regional focus on South Asia. In her dissertation, these fields come together to explore the changing place of television news in forming Indian public and popular culture.</p>
</div>
</div>