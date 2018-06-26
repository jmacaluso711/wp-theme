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

// INTERLACE ARRAYS
function array_interlace() {
    $args = func_get_args();
    $total = count($args);

    if($total < 2) {
        return FALSE;
    }

    $i = 0;
    $j = 0;
    $arr = array();

    foreach($args as $arg) {
        foreach($arg as $v) {
            $arr[$j] = $v;
            $j += $total;
        }

        $i++;
        $j = $i;
    }

    ksort($arr);
    return array_values($arr);
}

// DEBUG PRINT_R
function debug_print($var) {

    if ($var == null) {
        $var = "Variable is null!";
    }

    $var = print_r($var, true);

    $result = '<pre>';
    $result .= $var;
    $result .= '</pre>';


    echo $result;
}

/*
   Allow SVG uploads in wordpress backend
*/

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*
   Hash urls
*/

function hashUrl($string) {

   //Lower case everything
   $string = strtolower($string);

   //Make alphanumeric (removes all other characters)
   $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

   //Clean up multiple dashes or whitespaces
   $string = preg_replace("/[\s-]+/", " ", $string);

   //Convert whitespaces and underscore to dash
   $string = preg_replace("/[\s_]/", "-", $string);

   return $string;

}

// Get terms

function getTerms($tax) {

   $terms = get_the_terms($post->ID, $tax);

   if(is_array($terms) || is_object($terms)) {

      foreach($terms as $termIndex => $term) {

         if ($termIndex) {
            echo '<small>';
               echo $term->name;
               echo '<span>';
               echo ' | ';
               echo '</span>';
            echo '</small>';
         }

      }

   }

}

/**
 * @brief: Shows the subpages of the current page, or
 *         the adjacent sibling pages.
 **/
function show_subpages($sortBy, $sortOrder){

   global $post;
   $subpages = wp_list_pages( array(
      'echo'=>0,
      'title_li'=>'',
      'depth'=>2,
      'sort_column'=> $sortBy,
      'sort_order'=> $sortOrder,
      'child_of'=> ( $post->post_parent == 0 ? $post->ID : $post->post_parent)
   ));
   if ( !empty($subpages) ) {
      echo '<ul>';
      echo $subpages;
      echo '</ul>';
   } else {
      echo 'no subpages';
   }

}

<<<<<<< HEAD
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

=======
>>>>>>> d5f99e8250adb58fdf8beb135d909bc9614a6bb9
?>
