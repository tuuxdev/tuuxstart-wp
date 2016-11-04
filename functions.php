<?php

define('THEME_NAME', 'Custom Theme');
define('THEME_VERSION', '1.0.0');

/* =========================================================================
* PLUGIN / STYLE ENQUEUE
* ====================================================================== */

	function my_assets() {
		/*STYLES*/
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array());
		wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), THEME_VERSION); 
		wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css', array(), THEME_VERSION );
		/*SCRIPTS*/
		//wp_enqueue_script( 'jquery-two', get_template_directory_uri() . '/js/jquery-2.2.3.min.js', array());
		wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array(), THEME_VERSION, true );
	}
	add_action( 'wp_enqueue_scripts', 'my_assets' );

/* =========================================================================
 * RSS LINK <head>
 * ====================================================================== */
	
	automatic_feed_links();

/* =========================================================================
 * CLEAN UP <head>
 * ====================================================================== */	

	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

/* =========================================================================
 * WIDGET ZONE
 * ====================================================================== */

    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

/* =========================================================================
 * Menus <?php wp_nav_menu(array('theme_location' => 'main_nav', 'container' => false )); ?>
 * ====================================================================== */

	function register_my_menus() {
	  register_nav_menus(
		array(
		  'main_nav' => __( 'Main' ),
		)
	  );
	}
	add_action( 'init', 'register_my_menus' );

/* =========================================================================
 * FEATURE IMAGE
 * ====================================================================== */

	if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );

/* =========================================================================
 * CUSTOM BODY CLASSES
