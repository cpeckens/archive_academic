<?php

//add menu support
	add_theme_support( 'menus' );

//register menus
	function register_my_menus() {
  		register_nav_menus(
    		array( 'header-menu' => __( 'Header Menu' ), 'mobile-menu' => __( 'Mobile Menu' ))
  		);
	}
	
	// initiate register menus
		add_action( 'init', 'register_my_menus' );



//register thumbnail/featured image support
	add_theme_support( 'post-thumbnails' );

	// name of the thumbnail, width, height, crop mode
		add_image_size( 'page-image', 678, 204, true );
		add_image_size( 'thumbnail', 75, 75, true );





?>