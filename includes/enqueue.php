<?php

/* -------------------------------------------------------------------
    Enqueue Stuff
------------------------------------------------------------------- */

    // Header Scripts
    function header_scripts() {

     }
    add_action('wp_head', 'header_scripts');

    // Footer Scripts
    function footer_scripts() {

    }
    add_action('wp_footer', 'footer_scripts');

    function theme_scripts() {
        //Stylesheets
        wp_enqueue_style( 'screen', get_stylesheet_uri() );
        wp_enqueue_style( 'main', get_template_directory_uri().'/main.css' );      
        
        //jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false, '1.11.1', true);
                
        //Plugins
        wp_register_script( 'modernizr', get_template_directory_uri() . '/bower_components/modernizr-min/modernizr.min.js', array(), '2.8.3', false );
        wp_register_script( 'slick', get_template_directory_uri() . '/bower_components/slick-carousel/slick/slick.min.js', array(), '1.5.8', true );
        wp_register_script( 'countUp', get_template_directory_uri() . '/bower_components/countUp.js/dist/countUp.min.js', array(), '1.5.3', true );

        //Custom Scripts
        wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );
        
        //Enqueue Scripts
        wp_enqueue_script('modernizr');
        wp_enqueue_script('jquery');
        wp_enqueue_script('countUp');
        wp_enqueue_script('slick');
        wp_enqueue_script('main');

    }

    add_action( 'wp_enqueue_scripts', 'theme_scripts' );

?>