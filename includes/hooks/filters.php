<?php

add_action( 'template_redirect', function() {
  if ( isset( $_POST['filters'] ) ) {
    $data = array_filter( $_POST['filters'] );
    $location = add_query_arg( array( 'filters' => $data ), remove_query_arg( 'filters' ) );
    $location = str_replace(array( '%5B', '%5D', ' '), array( '[', ']', '+' ), $location );
    $location = preg_replace('/\/page\/\d+/', '', $location);
    wp_safe_redirect($location);
  }
});

add_action( 'query_vars', function ( $vars ){
  $vars[] = "filters";
  return $vars;
});

add_action( 'pre_get_posts', function($query) {
  if (!is_admin() && $query->is_main_query()):
    global $unfiltered_query;
    $args = array_merge($query->query_vars, array( 'nopaging' => true));
    $unfiltered_query = new WP_Query( $args );

    if (isset($query->query_vars['filters'])):
      $query->query_vars = filtered_query($query->query_vars);
    elseif (is_post_type_archive('artifact') || is_post_type_archive('course') || is_tax('person_role', 'faculty')):
      $query->set('nopaging', true);
    endif;

    if (is_tax('person_role') || is_post_type_archive('person')):
      $query->set('meta_key', 'last_name');
      $query->set('orderby', 'meta_value');
      $query->set('order', 'ASC');
    endif;

    if (is_post_type_archive('event')):
      $query->set('nopaging', true);
    endif;

    if (is_home()):
      $query->set('post_type', 'post');
    endif;

    if (is_search()):
      $query->set('orderby', 'type date');
      $query->set('posts_per_page', -1);
    endif;
  endif;

  $query->set('ignore_sticky_posts', true);
  return $query;
});
