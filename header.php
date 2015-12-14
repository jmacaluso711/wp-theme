<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
   <head>

      <!-- Basic Page Needs
      ================================================== -->
      <title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <!-- Mobile Specific Metas
      ================================================== -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">

      <!-- Pingback
      ================================================== -->
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

      <!-- Favicons
      ================================================== -->
      <?php include(get_stylesheet_directory() . '/includes/favicons.php'); ?>

      <!-- WP Head
      ================================================== -->
      <?php wp_head(); ?>

   </head>

   <body <?php body_class(); ?>>

   	<div class="site">
      
      <header class="site-header">
      	 <div class="site-header__logo"><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
         <?php if (has_nav_menu( 'primary' )) : ?>
         <?php wp_nav_menu(
				array(
					'container_class' => 'primary-nav-container',
					'depth' => 2,
					'theme_location' => 'primary',
					'link_before' => '<span>',
					'link_after' => '</span>',
					'menu_class' => 'primary-nav'
				)
			); ?>

		<?php else : ?>

			<p>Please set Primary nav.</p>

		<?php endif; ?>
      </header>

      <main>