<?php

/**
 * Generate class list for filmstrip item.
 *
 * Generates HTML class list for individual items in the filmstrip.
 * 
 * @param  array  $class_list Optional. List of existing classes.
 * @return array              List of all classes.
 */
function get_filmstrip_class_list( $class_list = array() ) {
	$class_list[] = 'post';

	if (is_single( get_the_ID() )) {
		$class_list[] = 'active';
	}

	return array_filter( array_unique( $class_list ) );
}

/**
 * Print class list for filmstrip item.
 *
 * Prints HTML class list for individual items in the filmstrip.
 * 
 * @param  array  $class_list Optional. List of existing classes.
 * @param  string $sep        Optional. Separator between classes. Defaults to space.
 * @return null
 */
function the_filmstrip_class_list( $class_list = array(), $sep = ' ' ) {
	echo implode( $sep, get_filmstrip_class_list( $class_list ) );
}

/**
 * Prints a filmstrip item.
 *
 * Sets up global post data and renders the filmstrip item template.
 * 
 * @param  object  $post_obj Filmstrip post object to render.
 * @return null
 */
function filmstrip_post($post_obj) {
	if (!empty($post_obj)):
  	global $post;
  	$post = $post_obj;
  	setup_postdata($post);
    get_template_part('templates/shared/filmstrip');
    wp_reset_postdata();
	else:
		echo '<div class="post empty"></div>';
	endif;
}
