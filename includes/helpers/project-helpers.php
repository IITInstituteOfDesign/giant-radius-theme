<?php

/**
 * Gets a list of artifacts in project that don't belong to a stage.
 * @return object WP_Query of artifacts.
 */
function the_project_artifacts() {
	return new WP_Query( array(
		'post_type' => 'artifact',
		'post__in' => get_field('artifact'),
		'orderby'  => 'post__in',
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'AND',
			array( 'key' => 'stage', 'value' => null )
		)
	));
}

/**
 * Modifies artifact query to filter by a specific stage.
 * @param  object $artifacts WP_Query object.
 * @param  string $stage     ACF stage to filter.
 * @return object            Modified WP_Query object.
 */
function filter_stage ($artifacts, $stage) {
	if ('final_result' === $stage) {
		$stage = 'deliverable';
	}

	$artifacts->set('meta_query', array(
		'relation' => 'AND',
		array( 'key' => 'stage', 'value' => $stage ),
		array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' )
	));
	$artifacts->get_posts();
	return $artifacts;
}

/**
 * Returns a list of other projects in the same topic as the current project.
 * @return object WP_Query object.
 */
function get_related_projects() {
	$topics = array();

	foreach (get_field('project') as $project) {
		$args = array( 'fields' => 'ids' );
		$terms = wp_get_post_terms( $project, 'topic', $args );
		$topics = array_merge( $terms, $topics );
	}

	$topics = array_unique( $topics );

	return new WP_Query( array(
		'post_type' => 'project',
		'post__not_in' => get_field('project'),
		'tax_query' => array(
			array(
				'taxonomy' => 'topic',
				'terms' => $topics
			)
		)
	));
}
