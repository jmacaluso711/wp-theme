<?php get_header(); ?>

<section class="row">

   <?php if ( have_posts() ): ?>
   <h2>Category Archive: <?php echo single_cat_title( '', false ); ?></h2>

   <?php while ( have_posts() ) : the_post(); ?>
      <article>
         <h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
         <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time>
         <?php the_content(); ?>
      </article>
   <?php endwhile; ?>

   <?php else: ?>
   <h2>No posts to display in <?php echo single_cat_title( '', false ); ?></h2>
   <?php endif; ?>

</section>

<?php get_footer(); ?>