		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="searchresults">
					
					<h2>Sorry, the page cannot be found.</h2>
					
					<p>Try searching again:</p>
					<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<div><input type="text" size="put_a_size_here" name="s" id="s" value="Search this site" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
<input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>

				
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End searchresults -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>