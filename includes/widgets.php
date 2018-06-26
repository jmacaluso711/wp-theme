<?php

/* -------------------------------------------------------------------
    Widget Area
------------------------------------------------------------------- */

    function theme_widgets_init() {

        register_sidebar( array(
            'name'          => __( 'Sidebar', 'ene' ),
            'id'            => 'sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>' . "\n" . '</div>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>' . "\n" . '<div class="widget-content">',
        ) );

    }

    add_action( 'widgets_init', 'theme_widgets_init' );

?>
