<?php

/**
 * Prints filter form tag.
 * @param  string $url Optional. URL to POST to. Defaults to current URL.
 * @return null
 */
function idiit_filter_form_tag( $url = '' ) {
	printf('<form action="%s" method="post" class="filters row">', $url);
}

/**
 * Populates option list for meta filter given an ACF field key.
 * @param  string $meta_key ACF field name/key.
 * @param  array  $args {
 *     Optional. Array of arguments.
 *     @type string  $sub_field    Name of sub_field to render if this is an ACF repeater field.
 *     @type boolean $relationship Is this a relationship field? Default true.
 * }
 * @return array List of available options.
 */
function idiit_meta_filter_values($meta_key, $args = array()) {
	$args = wp_parse_args($args, array(
		'sub_field' => '',
		'relationship' => true
	));

	if ($args['relationship'] === true) {
		return idiit_meta_relationship_values($meta_key);
	} elseif (!empty($args['sub_field'])) {
		return idiit_meta_repeater_values($meta_key, $args['sub_field']);
	} else {
		return idiit_meta_field_values($meta_key);
	}
}

/**
 * Retrieve a list of items related to the current set of posts.
 * @param  string $field_key ACF relationship field name/key.
 * @return array             List of IDs of related fields.
 */
function idiit_meta_relationship_values($field_key) {
	global $unfiltered_query;
	$terms = array();
	while ($unfiltered_query->have_posts()) : $unfiltered_query->the_post();
		$ids = get_field( $field_key );
		if (!empty($ids)) {
			$terms = array_merge( $terms, $ids );
		}
	endwhile;
	asort($terms);
	return array_unique( array_filter( $terms ) );
}

/**
 * Retrieve a list of meta terms from current set of posts.
 * @param  string $field_key ACF field name/key.
 * @return array             List of terms.
 */
function idiit_meta_field_values($field_key) {
	global $unfiltered_query;
	$terms = array();
	while ($unfiltered_query->have_posts()) : $unfiltered_query->the_post();
		$terms[] = get_field( $field_key );
	endwhile;
	asort($terms);
	return array_unique( array_filter( $terms ) );
}

/**
 * Retrieve a list of repeater sub_field terms from current set of posts.
 * @param  string $field_key     ACF field name/key.
 * @param  string $sub_field_key ACF repeater sub_field name/key.
 * @return array                 List of terms.
 */
function idiit_meta_repeater_values($field_key, $sub_field_key) {
	global $unfiltered_query;
	$terms = array();
	while ($unfiltered_query->have_posts()) : $unfiltered_query->the_post();
		while (have_rows($field_key)): the_row();
			$terms[] = get_sub_field( $sub_field_key );
		endwhile;
	endwhile;
	asort($terms);
	return array_unique( array_filter( $terms ) );
}

/**
 * Retrieve list of taxonomy terms assigned to current set of posts.
 * @param  string $taxonomy Name of taxonomy to retrieve terms from.
 * @return array           	List of taxonomy term objects.
 */
function idiit_tax_filter_values($taxonomy) {
	global $unfiltered_query;
	$ids = wp_list_pluck( $unfiltered_query->posts, 'ID' );
	return wp_get_object_terms( $ids, $taxonomy );
}

/**
 * Retrieve a list of dates from current set of posts.
 * @param  array  $return Initial list of dates to append to.
 * @return array          Complete list of dates.
 */
function idiit_date_filter_values($return = array()) {
	global $unfiltered_query;
	while ($unfiltered_query->have_posts()): $unfiltered_query->the_post();
		$return[] = get_idiit_date();
	endwhile;
	rsort($return);
	return array_unique( array_filter( $return ) );
}






function filtered_query( $args = array() ) {
	$filters = get_query_var('filters');

	$defaults = array(
		'post_type' => 'any',
    'posts_per_page' => -1,
		'tax_query' => array( 'relation' => 'AND' ),
		'meta_query' => array()
	);

	$args = array_merge( $defaults, $args );

  if (isset($filters['search'])):
    $args['s'] = $filters['search'];
  endif;

	if (!empty( $filters['topic'] )) {
		$args['tax_query'][] = array(
	    'taxonomy' => 'topic',
	    'field'    => 'slug',
	    'terms'    =>  $filters['topic'],
	    'operator' => 'AND'
	  );
	}

	if (!empty( $filters['artifact_type'] )) {
		$args['tax_query'][] = array(
	    'taxonomy' => 'artifact_type',
	    'field'    => 'slug',
	    'terms'    =>  $filters['artifact_type'],
	    'operator' => 'AND'
	  );
	}

	if (!empty( $filters['background'] )) {
		$args['tax_query'][] = array(
	    'taxonomy' => 'background',
	    'field'    => 'slug',
	    'terms'    =>  $filters['background'],
	    'operator' => 'AND'
	  );
	}


	if (!empty( $filters['course_type'] )) {
		$args['tax_query'][] = array(
	    'taxonomy' => 'course_type',
	    'field'    => 'term_id',
	    'terms'    =>  $filters['course_type']
	  );
	}

	if (!empty( $filters['event_type'] )) {
		$args['tax_query'][] = array(
	    'taxonomy' => 'event_type',
	    'field'    => 'term_id',
	    'terms'    =>  $filters['event_type']
	  );
	}

	if (!empty( $filters['person'] )) {
		$args['meta_query'][] = array(
	    'key'     => 'person',
      'field'   => 'term_id',
	    'value'   =>  $filters['person'],
      'compare' => 'LIKE'
	  );
	}

  if (!empty( $filters['degree'] )) {
    add_filter('posts_where', 'idiit_repeater_where');
    $args['meta_query'][] = array(
      'key'     => 'degrees_%_program',
      'value'   =>  $filters['degree']
    );
  }

  if (!empty( $filters['title'] )) {
    add_filter('posts_where', 'idiit_repeater_where');
    $args['meta_query'][] = array(
      'key'     => 'employment_%_position',
      'value'   =>  $filters['title']
    );
  }

	if (!empty( $filters['designation'] )) {
		$args['meta_query'][] = array(
      'key'     => 'designation',
	    'value'   =>  $filters['designation']
	  );
	}

  if (!empty( $filters['date'] )) {
    add_filter( 'posts_join', 'idiit_date_filter', 10, 2 );
  }

  return $args;
	return new WP_Query( $args );
};

function idiit_date_filter( $join, $where ) {
  $date = get_query_var('filters')['date'];
  global $wpdb;

  $new_join = "
    INNER JOIN {$wpdb->postmeta} pm1 ON 1=1
    AND pm1.post_id = {$wpdb->posts}.ID
    AND ((
      (pm1.meta_key = 'original_date' AND pm1.meta_value LIKE '$date%')
      OR (pm1.meta_key = 'source_date' AND pm1.meta_value LIKE '$date%')
      OR (pm1.meta_key = 'completion_date' AND pm1.meta_value LIKE '$date%')
      OR (pm1.meta_key = 'date' AND pm1.meta_value LIKE '$date%')
      OR (pm1.meta_key = 'date' AND pm1.meta_value LIKE '$date%')
    ) OR (
      {$wpdb->posts}.post_date LIKE '$date%'
    ))
    ";

  return $join . ' ' . $new_join;
}

function idiit_repeater_where( $where )
{
  $where = str_replace("meta_key = 'degrees_%_program'", "meta_key LIKE 'degrees_%_program'", $where);
  $where = str_replace("meta_key = 'employment_%_position'", "meta_key LIKE 'employment_%_position'", $where);

  return $where;
}
