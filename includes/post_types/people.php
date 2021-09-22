<?php

$person = new PostType('Person', 'People');
$person->image = 'dashicons-id';
$person->supports = array('thumbnail', 'editor', 'excerpt', 'revisions', 'page-attributes');
$person->taxonomies = array('person_role', 'post_tag');
$person->has_archive = false;

function generate_person_name( $post_id ) {
  // If this is a revision, get real post ID
  // if ( $parent_id = wp_is_post_revision( $post_id ) )
  //   $post_id = $parent_id;

  // if ( get_post_type($post_id) !== 'person' ) {
  //   return;
  // }


  // $logfile = '/var/log/php/error.log';
  // $message = json_encode( $post_id );
  // error_log("\n$message", 3, $logfile);

  if (get_field('first_name', $post_id) && get_field('last_name', $post_id)):
    $name = array( get_field('first_name', $post_id), get_field('last_name', $post_id) );
    $name = implode( ' ', array_filter( $name ));
    $slug = str_replace(' ', '-', $name);
    $slug = wp_unique_post_slug( $slug, $post_id, get_post_status($post_id), 'person', wp_get_post_parent_id($post_id));


    remove_action( 'acf/save_post', 'generate_person_name', 20 );

    wp_update_post( array(
      'ID' => $post_id,
      'post_title' => $name,
      'post_name' => $slug
    ));
  endif;
};

add_action( 'acf/save_post', 'generate_person_name', 20 );
