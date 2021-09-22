<?php
// Register Taxonomy Tag
// Taxonomy Key: tag
// function create_tag_tax() {

// 	$labels = array(
// 		'name'              => _x( 'Tags', 'taxonomy general name', 'textdomain' ),
// 		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'textdomain' ),
// 		'search_items'      => __( 'Search Tags', 'textdomain' ),
// 		'all_items'         => __( 'All Tags', 'textdomain' ),
// 		'parent_item'       => __( 'Parent Tag', 'textdomain' ),
// 		'parent_item_colon' => __( 'Parent Tag:', 'textdomain' ),
// 		'edit_item'         => __( 'Edit Tag', 'textdomain' ),
// 		'update_item'       => __( 'Update Tag', 'textdomain' ),
// 		'add_new_item'      => __( 'Add New Tag', 'textdomain' ),
// 		'new_item_name'     => __( 'New Tag Name', 'textdomain' ),
// 		'menu_name'         => __( 'Tag', 'textdomain' ),
// 	);
// 	$args = array(
// 		'labels' => $labels,
// 		'description' => __( 'Main tags', 'textdomain' ),
// 		'hierarchical' => false,
// 		'public' => true,
// 		'publicly_queryable' => true,
// 		'show_ui' => true,
// 		'show_in_menu' => true,
// 		'show_in_nav_menus' => true,
// 		'show_in_rest' => true,
// 		'show_tagcloud' => true,
// 		'show_in_quick_edit' => true,
// 		'show_admin_column' => true,
// 	);
// 	register_taxonomy( 'tag', array('post', 'page', ), $args );

// }
// add_action( 'init', 'create_tag_tax' );

// function wpa_cpt_tags( $query ) {
//     if ( $query->is_tag() && $query->is_main_query() ) {
//         $query->set( 'post_type', array( 'post', 'project', 'artifact', 'person', 'page', 'course' ) );
//     }
// }
// add_action( 'pre_get_posts', 'wpa_cpt_tags' );

// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');