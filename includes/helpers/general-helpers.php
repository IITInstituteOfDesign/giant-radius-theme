<?php

/**
 * Prints URL relative to theme root.
 * @param  string $path File path relative to theme root.
 * @return null
 */
function image_path( $path ) {
	echo get_template_directory_uri() . $path;
}

/**
 * Formats date by season.
 * @param  string $datestr Date string in YYYYMMDD format.
 * @return string          Seasonal date string. e.g. Spring 2015.
 */
function get_seasonal_date( $datestr ) {
	$month = (int) substr( $datestr, 4, 2 );
	if ($month <= 3) {
		return sprintf('Winter %s', substr( $datestr, 0, 4 ));
	} elseif ($month <= 6) {
		return sprintf('Spring %s', substr( $datestr, 0, 4 ));
	} elseif ($month <= 9) {
		return sprintf('Summer %s', substr( $datestr, 0, 4 ));
	} else {
		return sprintf('Fall %s', substr( $datestr, 0, 4 ));
	}
}

/**
 * Prints seasonal date.
 * @see    get_seasonal_date()
 * @param  string $datestr Date string in YYYYMMDD format.
 * @return null
 */
function the_seasonal_date( $datestr ) {
	echo get_seasonal_date( $datestr );
}

/**
 * Gets URL for date archive containing current item.
 * @return string Date archive URL.
 */
function get_date_permalink() {
	return sprintf('%s?filters[date]=%s', get_post_type_archive_link( get_post_type() ), get_idiit_date() );
}


/**
 * Prints URL of date archive containing current item.
 * @return null
 */
function the_date_permalink() {
	echo get_date_permalink();
}

/**
 * Create multidimensional array of posts grouped by key.
 * @param  string $key Key to group posts by.
 * @return array       Multidimensional array of grouped posts.
 */
function group_posts_by($key) {
	global $wp_query;
	$grouped = array();
	foreach($wp_query->posts as $post) {
		$grouped[$post->$key][] = $post;
	}
	return $grouped;
}

/**
 * Returns a heading for a post type given a count of items.
 * @param  string  $post_type Name of post type.
 * @param  integer $count     Number of items displayed.
 * @return string            	Concatenated count + label.
 */
function post_type_heading($post_type, $count = null) {
	$post_type = get_post_type_object( $post_type );
	$singular = $post_type->labels->singular_name;
	$plural = $post_type->labels->name;

	if (is_int($count)) {
		$label = _n($singular, $plural, $count);
		return "$count $label";
	} else {
		return $plural;
	}
}

/**
 * Pluralizes heading for post type based on count and registered labels.
 * @param  string  $post_type Name of post type.
 * @param  integer $count     Number of items displayed.
 * @return string             Pluralized name of post type.
 */
function pluralize_post_type($post_type, $count) {
	$post_type = get_post_type_object( $post_type );
	$singular = $post_type->labels->singular_name;
	$plural = $post_type->labels->name;
	return _n($singular, $plural, $count);
}

/**
 * Find end of first sentence from given content.
 * @param  string $content Content to analyze.
 * @return integer         String position of end of first sentence.
 */
function first_sentence_offset($content) {
	$content = html_entity_decode(strip_tags($content));
	return strpos($content, '. ');
}

/**
 * Determine if supplied content has more than one sentence.
 * @param  string  $content Content to test.
 * @return boolean          Whether the content has more than one sentence.
 */
function has_multiple_sentences($content) {
	$content = html_entity_decode(strip_tags($content));
	$pos = strpos($content, '. ');
	return $pos !== false;
}

/**
 * Plucks first sentence from given content.
 * @param  string $content Content to retrieve sentence from.
 * @return string          First sentence from content.
 */
function get_first_sentence($content) {
	$content = html_entity_decode(strip_tags($content));
	$pos = strpos($content, '. ');

	if($pos === false) {
		return wpautop( $content );
	}	else {
		return wpautop( substr($content, 0, $pos+1) );
	}
}

/**
 * Prints the first sentence from given content.
 * @see    get_first_sentence()
 * @param  string $content Content to print sentence from.
 * @return null
 */
function the_first_sentence($content) {
	echo get_first_sentence( $content );
}

/**
 * Returns supplied content without the first sentence.
 * @param  string $content Content to slice.
 * @return string          Remaining sentences.
 */
function get_other_sentences($content) {
	$content = html_entity_decode(strip_tags($content));
	$pos = strpos($content, '. ');

	if($pos === false) {
		return wpautop( $content );
	}	else {
		return wpautop( substr($content, $pos+1) );
	}
}

/**
 * Prints supplied content without the first sentence.
 * @see    get_other_sentences()
 * @param  string $content Content to slice.
 * @return null
 */
function the_other_sentences($content) {
	echo get_other_sentences( $content );
}

/**
 * Retrieves a list of registered taxonomies which are publicly queryable.
 * @return array List of public taxonomies.
 */
function get_public_taxonomies () {
	$taxonomies = get_object_taxonomies( get_query_var('post_type'), 'objects' );
	$taxonomies = array_filter( $taxonomies, function( $taxonomy ) {
		return $taxonomy->show_ui;
	});
	return $taxonomies;
}

/**
 * Retrieves date string based on available ACF fields.
 * @return string ISO formatted date.
 */
function get_idiit_date() {
	if (get_field('original_date')) {
    return get_field('original_date');
  } elseif (get_field('source_date')) {
    return get_field('source_date');
  } elseif (get_field('completion_date')) {
    return mysql2date( 'Y', get_field('completion_date') );
  } elseif (get_field('date')) {
    return mysql2date( 'Y', get_field('date') );
  } else {
    return get_the_date( 'Y' );
  }
}

/**
 * Returns the list of address options from Settings > General.
 * @return array Site address components.
 */
function get_site_address() {
  $address = array();
  $address[] = get_option('address1');
  $address[] = get_option('address2');
  $address[] = get_option('address3');
  return array_filter( $address );
}

/**
 * Prints the list of address options from Settings > General.
 * @param  string $sep Separator for joining options.
 * @return null
 */
function the_site_address( $sep = ' ' ) {
	echo implode($sep, get_site_address());
}

/**
 * Prints a link to the Google Map for the site address in Settings > General.
 * @return null
 */
function the_site_address_URL() {
	$address = implode('+', get_site_address());
	$address = preg_replace('/\s+/', '+', $address);
	printf('https://www.google.com/maps/?q=%s', $address);
}
