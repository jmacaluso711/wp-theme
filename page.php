<?php Theme_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>

   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   <h2><?php the_title(); ?></h2>
   <?php the_content(); ?>
   <?php endwhile; ?>

<?php Theme_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>