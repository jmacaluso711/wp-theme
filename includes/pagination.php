<?php

/* -------------------------------------------------------------------
    Pagination
------------------------------------------------------------------- */

    /**
     * Pagination for archives
     */
    function archive_pagination() {
        global $wp_query, $post;
        if ( $wp_query->max_num_pages > 1 ) {
            echo '<ul class="pager-nav">';
                    echo '<li class="nav-next">'. next_posts_link( __( '&larr; Older', 'bfn' ) ) .'</li>';
                    echo '<li class="nav-prev">'. previous_posts_link( __( 'Newer &rarr;', 'bfn' ) ) .'</li>';
            echo '</ul>';
        } // endif
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
    <?php
        }
    }

?>