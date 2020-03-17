<?php

// INCLUDES

// WP-Theme Functions
require_once(get_stylesheet_directory() . '/includes/utilities.php');
require_once(get_stylesheet_directory() . '/includes/enqueue.php');
require_once(get_stylesheet_directory() . '/includes/thumbnails.php');
require_once(get_stylesheet_directory() . '/includes/navigation.php');
require_once(get_stylesheet_directory() . '/includes/pagination.php');
require_once(get_stylesheet_directory() . '/includes/widgets.php');
require_once(get_stylesheet_directory() . '/includes/post-metas.php');
require_once(get_stylesheet_directory() . '/includes/custom-post-types.php');
require_once(get_stylesheet_directory() . '/includes/custom-taxonomies.php');

// ACF HOOKS
require_once(get_stylesheet_directory() . '/includes/acf-hooks.php');
require_once(get_stylesheet_directory() . '/includes/acf-theme-options.php');

?>
