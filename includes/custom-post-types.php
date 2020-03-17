<?php
  function create_post_types() {
    register_post_type( 'Updates', array(
        'public' => true,
        'hierarchical' => true,
        'menu_position' => 6,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-megaphone',
        'labels' => array(
          'name' => 'Updates',
          'singular_name' => 'Update',
          'add_new_item' => 'Add Update',
          'edit_item' => 'Edit Update'
        )
      )
    );
  }
  add_action( 'init', 'create_post_types' );
?>
