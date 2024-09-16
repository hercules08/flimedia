<?php
// Events
add_action('init', 'add_custom_post_type_events');
function add_custom_post_type_events()
{
  $single_label = 'Event';
  $plural_label = 'Events';
  $name = strtolower(str_replace(' ', '-', $plural_label));
  $slug = $name;
  $supports = array(
    'title', // post title
    'editor', // post content
    'author', // post author
    'thumbnail', // featured images
    // 'excerpt', // post excerpt
    'custom-fields', // custom fields
    // 'comments', // post comments
    'revisions', // post revisions
    'post-formats', // post formats
  );
  register_post_type($name, array(
    'label' => $plural_label,
    'description' => '',
    'public' => true,
    'publicly_queryable'  => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'capability_type' => 'page',
    'map_meta_cap' => true,
    'hierarchical' => false,
    'rewrite' => array('with_front' => false, 'slug' => $slug),
    'query_var' => true,
    'exclude_from_search' => false,
    'can_export' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-calendar-alt',
    'menu_position' => 20,
    'show_in_rest' => true,
    'supports' => $supports,
    'labels' => array(
      'name' => $plural_label,
      'singular_name' => $single_label,
      'menu_name' => $plural_label,
      'add_new' => 'Add ' . $single_label,
      'add_new_item' => 'Add New ' . $single_label,
      'edit' => 'Edit',
      'edit_item' => 'Edit ' . $single_label,
      'new_item' => 'New ' . $single_label,
      'view' => 'View ' . $single_label,
      'view_item' => 'View ' . $single_label,
      'search_items' => 'Search ' . $plural_label,
      'not_found' => 'No ' . $plural_label . ' Found',
      'not_found_in_trash' => 'No ' . $plural_label . ' Found in Trash',
      'parent' => 'Parent ' . $single_label,
    )
  ));
//   // Create Category
  register_taxonomy(
    $name . '_categories',
    $name,
    array(
      'labels' => array(
        'name' => $single_label . ' Categories',
        'singular_name' => 'Category',
        'menu_name' => $single_label . ' Categories',
        'add_new' => 'Add ' . $single_label,
        'add_new_item' => 'Add New Category',
        'edit' => 'Edit',
        'edit_item' => 'Edit Category',
        'new_item' => 'New Category',
        'view' => 'View Category',
        'view_item' => 'View Category',
        'search_items' => 'Search Categories',
      ),
      'show_in_rest' => true,
      'hierarchical' => true,
      'rewrite' => array('slug' => $name . '-categories', 'with_front' => false)
    )
  );
//   // Create Tags
//   register_taxonomy(
//     $name . '_tag',
//     array($name), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
//     array(
//       'hierarchical' => false,    /* if this is false, it acts like tags */
//       'labels' => array(
//         'name' => __($single_label . ' Tags'), /* name of the custom taxonomy */
//         'singular_name' => __($single_label . ' Tag'), /* single taxonomy name */
//         'menu_name' => __($single_label . ' Tags'),
//         'search_items' =>  __('Search ' . $single_label . ' Tags'), /* search title for taxomony */
//         'all_items' => __('All ' . $single_label . ' Tags'), /* all title for taxonomies */
//         'parent_item' => __('Parent ' . $single_label . ' Tag'), /* parent title for taxonomy */
//         'parent_item_colon' => __('Parent ' . $single_label . ' Tag:'), /* parent taxonomy title */
//         'edit_item' => __('Edit ' . $single_label . ' Tag'), /* edit custom taxonomy title */
//         'update_item' => __('Update ' . $single_label . ' Tag'), /* update title for taxonomy */
//         'add_new_item' => __('Add New ' . $single_label . ' Tag'), /* add new title for taxonomy */
//         'new_item_name' => __('New ' . $single_label . ' Tag Name') /* name title for taxonomy */
//       ),
//       'show_ui' => true,
//       'query_var' => true,
//     )
//   );
}
// Inventory
add_action('init', 'add_custom_post_type_inventory');
function add_custom_post_type_inventory()
{
  $single_label = 'Inventory';
  $plural_label = 'Inventory';
  $name = strtolower(str_replace(' ', '-', $plural_label));
  $slug = $name;
  $supports = array(
    'title', // post title
    'editor', // post content
    'author', // post author
    'thumbnail', // featured images
    // 'excerpt', // post excerpt
    'custom-fields', // custom fields
    // 'comments', // post comments
    'revisions', // post revisions
    'post-formats', // post formats
  );
  register_post_type($name, array(
    'label' => $plural_label,
    'description' => '',
    'public' => true,
    'publicly_queryable'  => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'capability_type' => 'page',
    'map_meta_cap' => true,
    'hierarchical' => false,
    'rewrite' => array('with_front' => false, 'slug' => $slug),
    'query_var' => true,
    'exclude_from_search' => false,
    'can_export' => true,
    'has_archive' => false,
    'menu_icon' => 'dashicons-car',
    'menu_position' => 20,
    'show_in_rest' => true,
    'supports' => $supports,
    'labels' => array(
      'name' => $plural_label,
      'singular_name' => $single_label,
      'menu_name' => $plural_label,
      'add_new' => 'Add ' . $single_label,
      'add_new_item' => 'Add New ' . $single_label,
      'edit' => 'Edit',
      'edit_item' => 'Edit ' . $single_label,
      'new_item' => 'New ' . $single_label,
      'view' => 'View ' . $single_label,
      'view_item' => 'View ' . $single_label,
      'search_items' => 'Search ' . $plural_label,
      'not_found' => 'No ' . $plural_label . ' Found',
      'not_found_in_trash' => 'No ' . $plural_label . ' Found in Trash',
      'parent' => 'Parent ' . $single_label,
    )
  ));
  //   // Create Category
  register_taxonomy(
    $name . '_vehicle_types',
    $name,
    array(
      'labels' => array(
        'name' => 'Vehicle Types',
        'singular_name' => 'Vehicle Type',
        'menu_name' => 'Vehicle Types',
        'add_new' => 'Add Vehicle Type',
        'add_new_item' => 'Add New Vehicle Type',
        'edit' => 'Edit',
        'edit_item' => 'Edit Vehicle Type',
        'new_item' => 'New Vehicle Type',
        'view' => 'View Vehicle Type',
        'view_item' => 'View Vehicle Type',
        'search_items' => 'Search Vehicle Types',
      ),
      'show_in_rest' => true,
      'hierarchical' => true,
      'rewrite' => array('slug' => 'vehicle-types', 'with_front' => false)
    )
  );
}