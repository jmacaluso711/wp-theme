<?php

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
      if ( $children != '' ) { ?>
        <nav class="widget widget-subnav">
            <h1 class="widget-title nav-title">
            <?php
              if ( $title )
                echo $title;
              else
                echo $top_parent_name;
            ?></h1>
            <div class="widget-content">
                <ul class="menu menu-secondary">
                    $children;
                </ul>
            </div>
        </nav>
      <?php }
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
      if ( $top_parent_children != '<li>No categories</li>' ) { ?>
            <nav class="widget widget-subnav">
                <h1 class="widget-title nav-title">'<?php echo $top_parent_name; ?></h1>
                    <div class="widget-content">
                        <ul class="menu menu-secondary">
                            <?php echo $top_parent_children; ?>
                        </ul>
                    </div>
            </nav>
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
  <?php
      }
    }
  }

?>