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
      <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico"/>
      <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
      <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

      <!-- WP Head
      ================================================== -->
      <?php wp_head(); ?>

   </head>

   <body <?php body_class(); ?>>
      
      <header>
         site header
      </header>