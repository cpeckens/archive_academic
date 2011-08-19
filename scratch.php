
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