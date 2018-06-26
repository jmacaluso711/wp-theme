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
  <meta name="author" content="John Macaluso">

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

  <!-- SVG Sprite
  ================================================== -->
  <?php include('img/svg-sprite/svg.svg'); ?>

  <header>
    site header
  </header>
