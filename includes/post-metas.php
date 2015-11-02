<?php

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

?>