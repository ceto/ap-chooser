<?php

  // Register Custom Post Type
function delta_custom_post_types() {

  // Lakások
  $labels = array(
    'name'                  => _x( 'Lakások', 'Member General Name', 'text_domain' ),
    'singular_name'         => _x( 'Lakás', 'Lakás Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Lakás választó', 'text_domain' ),
    'name_admin_bar'        => __( 'Lakás', 'text_domain' ),
    'archives'              => __( 'Lakás Archives', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent lakás:', 'text_domain' ),
    'all_items'             => __( 'Lakások', 'text_domain' ),
    'add_new_item'          => __( 'Új lakás felvétele', 'text_domain' ),
    'add_new'               => __( 'Új lakás', 'text_domain' ),
    'new_item'              => __( 'Új Lakás', 'text_domain' ),
    'edit_item'             => __( 'Lakás szerkesztése', 'text_domain' ),
    'update_item'           => __( 'Update Lakás', 'text_domain' ),
    'view_item'             => __( 'Lakás megtekintése', 'text_domain' ),
    'search_items'          => __( 'Search Lakás', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Lakás Photo', 'text_domain' ),
    'set_featured_image'    => __( 'Set Lakás photo', 'text_domain' ),
    'remove_featured_image' => __( 'Remove Lakás photo', 'text_domain' ),
    'use_featured_image'    => __( 'Use as Lakás photo', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into Lakás', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Lakás', 'text_domain' ),
    'items_list'            => __( 'Lakáss list', 'text_domain' ),
    'items_list_navigation' => __( 'Lakáss list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter Lakáss list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Lakás', 'text_domain' ),
    'description'           => __( 'Lakás Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'taxonomies'            => array(),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );

  register_post_type( 'lakas', $args );


   // Típuslakások
  $labels = array(
    'name'                  => _x( 'Lakás sablonok', 'Project General Name', 'text_domain' ),
    'singular_name'         => _x( 'Lakás sablon', 'Lakás sablon Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Lakás sablonok', 'text_domain' ),
    'name_admin_bar'        => __( 'Lakás sablon', 'text_domain' ),
    'archives'              => __( 'Lakás sablon Archives', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Lakás sablon:', 'text_domain' ),
    'all_items'             => __( 'Sablon lakások', 'text_domain' ),
    'add_new_item'          => __( 'Új lakás sablon', 'text_domain' ),
    'add_new'               => __( 'Új sablon', 'text_domain' ),
    'new_item'              => __( 'New Lakás sablon', 'text_domain' ),
    'edit_item'             => __( 'Edit Lakás sablon', 'text_domain' ),
    'update_item'           => __( 'Update Lakás sablon', 'text_domain' ),
    'view_item'             => __( 'View Lakás sablon', 'text_domain' ),
    'search_items'          => __( 'Search Lakás sablon', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Lakás sablons list', 'text_domain' ),
    'items_list_navigation' => __( 'Lakás sablons list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter Lakás sablons list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Lakás sablon', 'text_domain' ),
    'description'           => __( 'Lakás sablon Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'taxonomies'            => array(),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => 'edit.php?post_type=lakas',
    'menu_position'         => 5,
    'show_in_admin_bar'     => false,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'sablonlakas', $args );

}
add_action( 'init', 'delta_custom_post_types', 0 );


// Register Custom Taxonomies
function delta_custom_taxonomies() {
  //Project Category
  $labels = array(
    'name'                       => _x( 'Tömb kezelő', 'Project Category General Name', 'text_domain' ),
    'singular_name'              => _x( 'Project Category', 'Project Category Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Tömb kezelő', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Category', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
    'new_item_name'              => __( 'New Project Category Name', 'text_domain' ),
    'add_new_item'               => __( 'Új blokk felvétele', 'text_domain' ),
    'edit_item'                  => __( 'Blokk szerkesztése', 'text_domain' ),
    'update_item'                => __( 'Update Project Category', 'text_domain' ),
    'view_item'                  => __( 'Blokk megtekintése', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'blokk', array( 'lakas' ), $args );

}
add_action( 'init', 'delta_custom_taxonomies', 0 );

