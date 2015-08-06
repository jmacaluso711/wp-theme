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

?>