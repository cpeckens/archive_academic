<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title><?php if ( is_front_page() ) { ?><?php bloginfo('description'); ?>&nbsp;<? bloginfo('name'); } else { wp_title(''); ?> | Department of <?php bloginfo('name'); } ?></title>

		<!-- Meta tags -->
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Don't forget to update the bookmark icons (favicon.ico and apple-touch-icons) in the root: http://mathiasbynens.be/notes/touch-icons -->
		<?php $ksasaca_option = ksasaca_get_global_options(); ?>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/colors/<?php echo $ksasaca_option['ksasaca_select_input']; ?>.css" />

		<!--[if lte IE 8]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/ie<?php echo $ksasaca_option['ksasaca_select_input']; ?>.css" />
		<![endif]-->
		<!--[if lte IE 7]>
		<style>#header {margin-top: 0;}</style>
		<![endif]-->
	<?php if (is_front_page()) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/flexslider.css" />
	<?php } ?>
		<!--Wordpress Neccessities -->
		<?php wp_enqueue_script('jquery'); ?> 
		<?php wp_head(); ?>
		<!-- JavaScript -->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	
	<body <?php if (is_front_page()) { ?>class="home"<?php } else { ?> class="page"<?php } ?>>
		<div id="container-head">
			
			<div id="header">
				
				<div id="header-left">
				<div id="logo"><a href="http://krieger.jhu.edu" title="Johns Hopkins University Zanvyl Krieger School of Arts & Sciences"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo<?php echo $ksasaca_option['ksasaca_select_input']; ?>.png" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences" /></a></div>
				</div> <!-- End header-left -->
			
				<div id="header-right">
					
					<div id="blogtitle">
					<a href="<?php bloginfo('url'); ?>"><h1 class="little">Department of</h1>
					<h1><?php bloginfo('name'); ?></h1></a>
					</div>
					
					<div id="searchbar">
					<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<div><label title="search" /><input type="text" size="put_a_size_here" name="s" id="s" value="Search this site" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
<input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>
					</div>
					
					
					
				</div><!-- End header-right -->
									<div id="searchbar" class="mobile">
					<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<div><input type="text" size="put_a_size_here" name="s" id="s" value="Search this site" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
<input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>
					</div>

				<div id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
					<div class="clearboth"></div> <!--to have background work properly -->
					</div> <!--End nav -->
			
			</div> <!-- End header -->
			
		</div> <!-- End container-head-->
		
		<div id="nav-break"></div>
	
									
