<?php

/* -------------------------------------------------------------------
    Enqueue Stuff
------------------------------------------------------------------- */

    // Header Scripts
    function header_scripts() {

<<<<<<< HEAD
    }
=======
     }
>>>>>>> d5f99e8250adb58fdf8beb135d909bc9614a6bb9
    add_action('wp_head', 'header_scripts');

    // Footer Scripts
    function footer_scripts() {

    }
    add_action('wp_footer', 'footer_scripts');

    function theme_scripts() {
<<<<<<< HEAD
      //Stylesheets
      wp_enqueue_style( 'screen', get_stylesheet_uri() );
      wp_enqueue_style( 'main', get_template_directory_uri().'/dist/css/main.css' );

      //jQuery
      // wp_deregister_script('jquery');
      // wp_enqueue_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '3.1.0', true);

      //Plugins
      // wp_register_script( 'modernizr', get_template_directory_uri() . '/bower_components/modernizr-min/dist/modernizr.min.js', array(), '3.2.0', false );

      //Custom Scripts
      wp_register_script( 'main', get_template_directory_uri() . '/dist/js/bundle.js', array(), '1.0.0', true );

      //Enqueue Scripts
      // wp_enqueue_script('modernizr');
      wp_enqueue_script('jquery');
      wp_enqueue_script('main');
=======
        //Stylesheets
        wp_enqueue_style( 'screen', get_stylesheet_uri() );
        wp_enqueue_style( 'main', get_template_directory_uri().'/build/css/main.css' );

        //jQuery
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '3.1.0', true);

        //Plugins
        // wp_register_script( 'modernizr', get_template_directory_uri() . '/bower_components/modernizr-min/dist/modernizr.min.js', array(), '3.2.0', false );

        //Custom Scripts
        wp_register_script( 'main', get_template_directory_uri() . '/build/js/main.js', array(), '1.0.0', true );

        //Enqueue Scripts
        // wp_enqueue_script('modernizr');
        wp_enqueue_script('jquery');
        wp_enqueue_script('main');
>>>>>>> d5f99e8250adb58fdf8beb135d909bc9614a6bb9

    }

    add_action( 'wp_enqueue_scripts', 'theme_scripts' );

?>
