<?php

    /**
     * Header scripts
     */
    function header_scripts() {

    }
    add_action('wp_head', 'header_scripts');

    /**
     * Footer scripts
     */
    function footer_scripts() {

    }
    add_action('wp_footer', 'footer_scripts');

    function theme_scripts() {
      /**
       * Stylesheets
       */
      wp_enqueue_style( 'screen', get_stylesheet_uri() );
      wp_enqueue_style( 'main', get_template_directory_uri().'/dist/css/main.css' );

      /**
       * Custom js bundle
       */
      wp_register_script( 'main', get_template_directory_uri() . '/dist/js/bundle.js', array(), '1.0.0', true );

      /**
       * Enqueue js
       */
      wp_enqueue_script('jquery');
      wp_enqueue_script('main');
    }
    add_action( 'wp_enqueue_scripts', 'theme_scripts' );

?>
