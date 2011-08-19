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
	</head>
	
	<body>

		<div id="container-head">
			
			<div id="header">
				
				<div id="header-left">
				<h1>LOGO</h1>
				</div> <!-- End header-left -->
			
				<div id="header-right">
					
					<div id="nav">
					<h2>Department of Economics</h2>
					<? //php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?><p>Navigation</p>
					</div> <!--End nav -->
					
				</div><!-- End header-right -->
		
			</div> <!-- End header -->
	
		</div> <!-- End container-head-->
	
		
		
