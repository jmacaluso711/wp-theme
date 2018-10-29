<?php get_header(); ?>

   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <h1><?php the_title(); ?></h1>

      <?php the_content(); ?>

      <?php
        // $acf_flexible_content = 'page_content';
        // include(locate_template('/flexible_content/acf-flexible-content.php'));
      ?>

   <?php endwhile; ?>

<?php get_footer(); ?>
