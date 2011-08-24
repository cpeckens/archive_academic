<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title></title>

		<!-- Meta tags -->
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Don't forget to update the bookmark icons (favicon.ico and apple-touch-icons) in the root: http://mathiasbynens.be/notes/touch-icons -->

		<!-- CSS -->
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />

		<!-- JavaScript -->
		<!--[if IE]><![endif]-->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="assets/js/respond.min.js"></script>
		
		<!--Wordpress Neccessities -->
			<?php wp_enqueue_script('jquery'); ?> 
			<?php wp_head(); ?>
		
		<!-- home specific scripts and css -->
			<?php if (is_front_page()) { ?>
			<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.flexslider-min.js"></script>
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/flexslider.css" />
			<?php } ?>
		<!-- end home specific scripts -->
	</head>
	
	<body>
		<div id="container-head">
			
			<div id="header">
				
				<div id="header-left">
				<div id="logo"><a href="http://krieger.jhu.edu"><img src="<?php bloginfo('template_url'); ?>/assets/img/logo.gif" alt="Johns Hopkins Univeristy Zanvyl Krieger School of Arts & Sciences" /></a></div>
				</div> <!-- End header-left -->
			
				<div id="header-right">
					
					<div id="blogtitle">
					<h1 class="little">Department of</h1>
					<h1><?php bloginfo('name'); ?></h1>
					</div>
					
					
					
				</div><!-- End header-right -->
				<div id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
					<div class="clearboth"></div> <!--to have background work properly -->
					</div> <!--End nav -->
			
			</div> <!-- End header -->
			
		</div> <!-- End container-head-->
	
		
		
