<?php

/* -------------------------------------------------------------------
   Utilities
------------------------------------------------------------------- */

class Theme_Utilities {
   
   public static function get_template_parts( $parts = array() ) {
        foreach( $parts as $part ) {
        get_template_part( $part );
        };
   }

   public static function add_slug_to_body_class( $classes ) {
     global $post;

     if( is_page() ) {
     $classes[] = sanitize_html_class( $post->post_name );
     } elseif(is_singular()) {
     $classes[] = sanitize_html_class( $post->post_name );
     };

     return $classes;
   }

}

/* -------------------------------------------------------------------
   Enqueue Stuff
------------------------------------------------------------------- */

   function theme_scripts() {
      //Stylesheets
      wp_enqueue_style( 'screen', get_stylesheet_uri() );
      wp_enqueue_style( 'main', get_template_directory_uri().'/scss/css/main.css' );      
      
      //jQuery
      wp_deregister_script('jquery');
      wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false, '1.11.1', true);
            
      //Plugins
      wp_register_script( 'flexslider', get_template_directory_uri() . '/js/plugins/jquery.flexslider-min.js', array(), '2.2.2', true );

      //Custom Scripts
      wp_register_script( 'scripts', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );
      
      //Enqueue Scripts
      wp_enqueue_script('jquery');
      wp_enqueue_script('flexslider');
      wp_enqueue_script('scripts');
      wp_enqueue_script('main');
   }

   add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/* -------------------------------------------------------------------
   Thumbnails
------------------------------------------------------------------- */

   add_theme_support('post-thumbnails');
   add_image_size( 'post-thumbnail', 150, 150, true );

   //Remove Height and Width Attributes on images
   add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
   add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

   function remove_width_attribute( $html ) {
      $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
      return $html;
   }

/* -------------------------------------------------------------------
   Navigation
------------------------------------------------------------------- */

   register_nav_menus(array(
      'primary' => 'Primary Navigation',
      'secondary' => 'Secondary Navigation',
      'footer' => 'Footer Navigation'
   ));


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

/* -------------------------------------------------------------------
   Post Metas
------------------------------------------------------------------- */
   
   if ( ! function_exists( 'header_meta' ) ) {
      function wolf_header_meta() { ?>
      <div class="post-date">
         <time datetime="<?php echo get_the_date( 'c' ); ?>" pubdate>
            <span>
               <?php echo get_the_date( 'M' ); ?>
            </span>
            <span>
               <?php echo get_the_date( 'd' ); ?>
            </span>
            <span>
               <?php echo get_the_date( 'Y' ); ?>
            </span>
         </time>
      </div><!-- /.entry-meta -->
      <?php }
   }

   if ( ! function_exists( 'post_meta' ) ) {
      function ene_post_meta() { ?>
         <div class="post-meta">
         <span class="cats"> Category: <?php the_category( ', ' ); ?></span>
         <?php edit_post_link('| Edit', ' <span class="edit">', '</span>'); ?>
         </div>
      <?php }
   }

?>