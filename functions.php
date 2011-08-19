<?php

//add menu support
	add_theme_support( 'menus' );

//register menus
	function register_my_menus() {
  		register_nav_menus(
    		array( 'header-menu' => __( 'Header Menu' ), 'extra-menu' => __( 'Extra Menu' ))
  		);
	}
	
	// initiate register menus
	add_action( 'init', 'register_my_menus' );















?>