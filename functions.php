<?php

/* -------------------------------------------------------------------
   Utilities
------------------------------------------------------------------- */

class Utilities {
    
    /**
       * Simple wrapper for native get_template_part()
       * Allows you to pass in an array of parts and output them in your theme
       * e.g. <?php get_template_parts(array('part-1', 'part-2')); ?>
       *
       * @param   array 
       * @return  void
       * @author  Keir Whitaker
    **/
    public static function get_template_parts( $parts = array() ) {
        foreach( $parts as $part ) {
          get_template_part( $part );
        };
    }

    /**
     * Append page slugs to the body class
     * NB: Requires init via add_filter('body_class', 'add_slug_to_body_class');
     *
     * @param   array 
     * @return  array
     * @author  Keir Whitaker
    */
    public static function add_slug_to_body_class( $classes ) {
      global $post;

      if( is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
      } elseif(is_singular()) {
        $classes[] = sanitize_html_class( $post->post_name );
      };

      return $classes;
    }

    /**
     * Get the category id from a category name
     *
     * @param   string 
     * @return  string
     * @author  Keir Whitaker
    */
    public static function get_category_id( $cat_name ){
        $term = get_term_by( 'name', $cat_name, 'category' );
        return $term->term_id;
    }

}

// Init for body class
add_filter( 'body_class', array( 'Utilities', 'add_slug_to_body_class' ) );

/* -------------------------------------------------------------------
   Enqueue Stuff
------------------------------------------------------------------- */

   // Header Scripts
   function header_scripts() { ?>

   <?php }
   add_action('wp_head', 'header_scripts');

   // Footer Scripts
   function footer_scripts() { ?> 

   <? }
   add_action('wp_footer', 'footer_scripts');

   function theme_scripts() {
      //Stylesheets
      wp_enqueue_style( 'screen', get_stylesheet_uri() );
      wp_enqueue_style( 'main', get_template_directory_uri().'/main.css' );      
      
      //jQuery
      wp_deregister_script('jquery');
      wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false, '1.11.1', true);
            
      //Plugins

      //Custom Scripts
      wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );
      
      //Enqueue Scripts
      wp_enqueue_script('jquery');
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
  
  /**
   * WP Navigation
   */
  register_nav_menus(array(
    'primary' => 'Primary Navigation',
    'secondary' => 'Secondary Navigation',
    'footer' => 'Footer Navigation'
  ));

  /**
   * Get top parent page id - used in page subnav function
   */
  function get_top_parent_page_id() {
      global $post;
      $ancestors = $post->ancestors;
      if ( $ancestors ) {
          return end( $ancestors );
      } else {
          return $post->ID;
      }
  }

  // page subnav function
  function page_subnav( $title = '' ) {
    global $post;
    if ( is_page() ) {
      $top_parent = bfn_get_top_parent_page_id( $post->ID );
      $parent = $post->post_parent;
      $children = wp_list_pages( array(
        'sort_column' => 'menu_order',
        'title_li' => '',
        'child_of' => $top_parent,
        'echo' => 0
      ) );
      $top_parent_name = get_the_title( $top_parent );
      if ( $children != '' ) {
  ?>
  <nav class="widget widget-subnav">
    <h1 class="widget-title nav-title"><?php
      if ( $title )
        echo $title;
      else
        echo $top_parent_name;
      ?></h1>
    <div class="widget-content">
      <ul class="menu menu-secondary">
        <?php echo $children; ?>
      </ul>
    </div><!-- .widget-content -->
  </nav><!-- .widget.widget-subnav -->
  <?php
      } // endif
    } // endif
  }

  /**
   * Subnav of current category's topmost parent's children, outputted as widget
   * todo - make it an actual widget
   */
  function category_subnav() {
    global $post;
    if ( is_category() || is_single() ) {
      $categories = get_the_category();
      $category = array_shift( $categories );
      $top_parent = ( $category->category_parent ) ? $category->category_parent : $category->cat_ID;
      $top_parent_name = get_cat_name( $top_parent );
      $top_parent_children = wp_list_categories( array(
        'child_of' => $top_parent,
        'title_li' => '',
        'echo' => 0
      ) );
      if ( $top_parent_children != '<li>No categories</li>' ) {
  ?>
  <nav class="widget widget-subnav">
    <h1 class="widget-title nav-title"><?php echo $top_parent_name; ?></h1>
    <div class="widget-content">
      <ul class="menu menu-secondary">
        <?php echo $top_parent_children; ?>
      </ul>
    </div><!-- /.widget-content -->
  </nav><!-- /.widget.widget-subnav -->
  <?php }
    }
  }

  /**
   * Subnav of current post or taxonomy's topmost parent's children, outputted as widget
   * todo - make it an actual widget that allows you to select the taxonomy
   */
  function taxonomy_subnav( $tax = '', $title = '' ) {
    global $post;
    if ( is_tax( $tax ) || is_single() ) {
      $terms = get_the_terms( $post->ID, $tax );
      $term = array_pop( $terms );
      $top_parent_term = ( $term->parent ? $term->parent : $term->term_id );
      $top_parent_term_name = $top_parent_term->name;
      $top_parent_children = wp_list_categories( array(
        'child_of' => $top_parent_term,
        'title_li' => '',
        'echo' => 0,
        'taxonomy' => $tax
      ) );
      if ( $top_parent_children != '<li>No categories</li>' ) {
  ?>
  <nav class="widget widget-subnav">
    <h1 class="widget-title nav-title"><?php
      if ( $title )
        echo $title;
      else
        echo $top_parent_term_name;
      ?></h1>
    <div class="widget-content">
      <ul class="menu menu-secondary">
        <?php echo $top_parent_children; ?>
      </ul>
    </div><!-- .widget-content -->
  </nav><!-- .widget.widget-subnav.widget-subnav-taxonomies -->
  <?php }
    }
  }

/* -------------------------------------------------------------------
  Pagination
------------------------------------------------------------------- */

  /**
   * Pagination for archives
   */
  function archive_pagination() {
    global $wp_query, $post;
    if ( $wp_query->max_num_pages > 1 ) {
  ?>
    <ul class="pager-nav">
      <li class="nav-next"><?php next_posts_link( __( '&larr; Older', 'bfn' ) ); ?></li>
      <li class="nav-prev"><?php previous_posts_link( __( 'Newer &rarr;', 'bfn' ) ); ?></li>
    </ul>
  <?php } // endif
  }

  /**
   * Pagination for single posts
   */
  function single_pagination() {
    global $wp_query, $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next = get_adjacent_post( false, '', false );

    if ( $next || $previous ) {
  ?>
    <ul class="pager-nav">
      <li class="nav-next"><?php next_post_link( '&larr; %link' ); ?></li>
      <li class="nav-prev"><?php previous_post_link( '%link &rarr;' ); ?></li>
    </ul>
  <?php }
  }

  /*
  * Pagination One Way
  */
  function one_way_pagination() {
    global $wp_query, $post;
    $next_post = get_adjacent_post(false, '', false);
    $next_description = get_field('title', $next_post->ID);

    echo '<nav class="one-way-pager">';
    if(!empty($next_post)) {
      echo '<a class="one-way--next" href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"><span class="single-nav-title">' . $next_post->post_title . '</span><span class="single-nav-desc">'. $next_description .'</span><i class="icon-circle-right"></i></a>';
    } else {
      echo '<span class="one-way--end">End of Report</span>';
    }
    echo '</nav>';
  }

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
      function header_meta() { ?>
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
      function post_meta() { ?>
         <div class="post-meta">
         <span class="cats"> Category: <?php the_category( ', ' ); ?></span>
         <?php edit_post_link('| Edit', ' <span class="edit">', '</span>'); ?>
         </div>
      <?php }
   }

/* -------------------------------------------------------------------
   Footnotes
------------------------------------------------------------------- */

	//Create footnote shortcode
	function footnote($atts, $content = null) {
		extract(shortcode_atts(array(
			"tooltip" => $tooltip
		), $atts));

		static $number = 1;
		return '<sup><a class="footnote-tooltip" title="'.$tooltip.'">'. '[' . $number++ . ']' .'</a></sup>';
	}
	add_shortcode('footnote', 'footnote');

	// Add buttons to wysiwyg editor
	add_action('init', 'add_buttons');
	function add_buttons() {
	   if ( current_user_can('edit_posts') && current_user_can('edit_pages') )
	   {
	     add_filter('mce_external_plugins', 'add_plugin');
	     add_filter('mce_buttons', 'register_button');
	   }
	}
	function register_button($buttons) {
	   array_push($buttons, "footnote");
	   return $buttons;
	}

	function add_plugin($plugin_array) {
	   $plugin_array['footnote'] = get_template_directory_uri() . '/js/footnotes.js';
	   return $plugin_array;
	}

	function footnote_table_of_contents($content) {
		
		global $post;

		$content = get_sub_field('content');

		preg_match_all('/<a class="footnote-tooltip"[^>]+>(.*)<\/a>/smU', $content, $result);

		$footnote_array = array();

		if (!empty($result) && !empty($result[0])) {
			echo '<footer class="footer-footnotes">';
				echo '<h2 class="footer-footnotes__title">Footnotes</h2>';
				echo '<ol>';
				foreach($result[0] as $footnote) {
					preg_match_all('/(title)=("[^"]*")/smU',$footnote,$footnote_array[$footnote]);
					echo '<li>' . str_replace('"','',$footnote_array[$footnote][2][0]) . '</li>';
				}
				echo '</ol>';
			echo '</footer>';
		}

	}

	add_action( 'admin_enqueue_scripts', 'footnote_enqueue_admin_scripts' );
	function footnote_enqueue_admin_scripts() {
	    wp_enqueue_script( 'jquery' );
	}

?>