<?php

$event = new PostType('Event');
$event->image = 'dashicons-calendar-alt';
$event->supports[] = 'thumbnail';
$event->taxonomies = array('event_type');

add_filter( 'generate_rewrite_rules', function ($wp_rewrite) {
  $cpt = 'event';
  $rules = array();
  $post_type = get_post_type_object( $cpt );
  $slug_archive = $post_type->has_archive;
  if ( $slug_archive === false ) return $rules;
  if ( $slug_archive === true ) {
    $slug_archive = $post_type->rewrite['slug'] ? $post_type->rewrite['slug'] : $post_type->name;
  }
  $dates = array(
    array(
      'rule' => "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})",
      'vars' => array( 'year', 'monthnum', 'day' )
    ),
    array(
      'rule' => "([0-9]{4})/([0-9]{1,2})",
      'vars' => array( 'year', 'monthnum' )
    ),
    array(
      'rule' => "([0-9]{4})",
      'vars' => array( 'year' )
    )
  );
  foreach ($dates as $data) {
    $query = 'index.php?post_type='.$cpt;
    $rule = $slug_archive.'/'.$data['rule'];
    $i = 1;
    foreach ( $data['vars'] as $var ) {
      $query.= '&'.$var.'='.$wp_rewrite->preg_index($i);
      $i++;
    }
    $rules[$rule."/?$"] = $query;
    $rules[$rule."/feed/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
    $rules[$rule."/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
    $rules[$rule."/page/([0-9]{1,})/?$"] = $query."&paged=".$wp_rewrite->preg_index($i);
  }
  $rules[$slug_archive."/([^/]+)/([^/]+)/?$"] = 'index.php?post_type=speaker&event_name='.$wp_rewrite->preg_index(1).'&name='.$wp_rewrite->preg_index(2);
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
  return $wp_rewrite;
});

add_filter( 'template_redirect', function() {
	if ( is_singular( 'event' ) && get_field('conference_url') ) {
		wp_redirect( get_field('conference_url'), 301 );
		exit;
	}
});
