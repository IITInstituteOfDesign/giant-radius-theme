<?php

/**
 * Retrieve courses in term.
 * 
 * Filters main query to only include immediate children of the current term.
 * @return null
 */
function get_courses() {
	global $wp_query;
	$wp_query->set('tax_query', get_immediate_children());
	$wp_query->get_posts();
}

/**
 * Retrieve child courses.
 * 
 * Gets child courses of the term which are not assigned to any of its children.
 * 
 * @param  object $course_type A course_type term object. Defaults to current term.
 * @return array               Valid tax_query multidimensional array
 */
function get_immediate_children( $course_type = null ) {
	if (empty($course_type)) {
		$course_type = get_term_by('slug', get_query_var('term'), 'course_type');
	}

	return array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'course_type',
			'terms' => $course_type->term_id
		),
		array(
			'taxonomy' => 'course_type',
			'terms' => get_term_children( $course_type->term_id, 'course_type'),
			'operator' => 'NOT IN'
		)
	);
}
