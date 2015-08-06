<?php

/* -------------------------------------------------------------------
   Thumbnails
------------------------------------------------------------------- */

    add_theme_support('post-thumbnails');
    add_image_size( 'post-thumbnail', 150, 150, true );
    add_image_size( 'banner-thumbnail', 1500, 500, true );

    //Remove Height and Width Attributes on images
    add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
    add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

    function remove_width_attribute( $html ) {
        $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
        return $html;
    }


?>