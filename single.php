<?php get_header(); ?>

   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <article>

         <h1><?php the_title(); ?></h1>

         <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time>

         <?php the_content(); ?>

      </article>

   <?php endwhile; ?>

<?php get_footer(); ?>
