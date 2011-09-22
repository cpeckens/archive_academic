<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title><?php if ( is_front_page() ) { ?><? bloginfo('name'); ?> - <?php bloginfo('description'); } else { wp_title(''); } ?></title>

		<!-- Meta tags -->
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Don't forget to update the bookmark icons (favicon.ico and apple-touch-icons) in the root: http://mathiasbynens.be/notes/touch-icons -->

		<!-- CSS -->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />
		<!--[if lte IE 8]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/ie.css" />
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
	
	<body>
		<div id="container-head">
			
			<div id="header">
				
				<div id="header-left">
				<div id="logo"><a href="http://krieger.jhu.edu" title="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences" /></a></div>
				</div> <!-- End header-left -->
			
				<div id="header-right">
					
					<div id="blogtitle">
					<h1 class="little">Department of</h1>
					<h1><?php bloginfo('name'); ?></h1>
					</div>
					
					<div id="searchbar">
					<?php include (TEMPLATEPATH . ‘/searchform.php’); ?>
					</div>
					
					
					
				</div><!-- End header-right -->
				<div id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
					<div class="clearboth"></div> <!--to have background work properly -->
					</div> <!--End nav -->
			
			</div> <!-- End header -->
			
		</div> <!-- End container-head-->
		
		<div id="nav-break"></div>
	
									
