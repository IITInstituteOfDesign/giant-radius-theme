<?php 
/*
** Student Profiles CPT
*/
function my_custom_post_profile() {
  $labels = array(
    'name'               => _x( 'Profiles', 'post type general name' ),
    'singular_name'      => _x( 'Profile', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'profile' ),
    'add_new_item'       => __( 'Add New Profile' ),
    'edit_item'          => __( 'Edit Profile' ),
    'new_item'           => __( 'New Profile' ),
    'all_items'          => __( 'All Profiles' ),
    'view_item'          => __( 'View Profile' ),
    'search_items'       => __( 'Search Profiles' ),
    'not_found'          => __( 'No profiles found' ),
    'not_found_in_trash' => __( 'No profiles found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Profiles'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Student and alumni profiles for recruitID',
    'public'        => true,
    'menu_position' => 7,
    'menu_icon'     => 'dashicons-universal-access',
    // 'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','custom-fields' ),
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    'has_archive'   => false,
  );
  register_post_type( 'profile', $args ); 
}
add_action( 'init', 'my_custom_post_profile' );