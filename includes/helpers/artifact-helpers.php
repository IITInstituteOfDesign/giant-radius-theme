<?php

/**
 * Default image size to use for artifacts.
 */
define('IDIIT_ARTIFACT_SIZE', 'full');

/**
 * Retrieves image attached to artifact.
 *
 * Runs artifact through some conditional logic to find an image to display.
 * Prefers ACF "image" field, then checks for wordpress post thumbnail, finally
 * falls back to just returning the artifact title. Image is wrapped in a link.
 * 
 * @param  string $post_id Passed to ACF. Defaults to global $post.
 * @param  string $size    Registered image_size to return
 * @return string          HTML code to display image.
 */
function get_artifact_image( $post_id = null, $size = IDIIT_ARTIFACT_SIZE) {
	if (empty($post_id)) {
		$post_id = get_the_ID();
	}

	if (get_field('url', $post_id)) {
		$url = get_field('url', $post_id);
	} elseif (get_field('file', $post_id)) {
		$url = wp_get_attachment_url( get_field('file', $post_id) );
	} else {
		$url = false;
	}

	if (get_field('image', $post_id)) {
		$content = wp_get_attachment_image( get_field('image', $post_id), $size );
	} elseif (has_post_thumbnail()) {
		$content = get_the_post_thumbnail( get_the_ID(), $size );
	} else {
		$content = get_the_title();
	}

	if (!empty($url)):
		return sprintf('<a href="%s" target="_blank">%s</a>', $url, $content);
	else:
		return $content;
	endif;
}

/**
 * Get oembed html.
 *
 * Runs ACF url field after running it through the built-in embed shortcode.
 *
 * @param  string $post_id Passed to ACF. Defaults to global $post.
 * @return string          oembed html
 */
function get_artifact_video( $post_id = null ) {
	if (empty($post_id)) {
		$post_id = get_the_ID();
	}

	$url = get_field('url', $post_id);
	return wp_oembed_get( $url );
}

/**
 * Prints the artifact html.
 *
 * Displays either a static image wrapped in a link or an oembed video.
 *
 * @see get_artifact_image()
 * @param  string $post_id Passed to ACF. Defaults to null.
 * @return null
 */
function the_artifact( $post_id = null ) {
	$embed = get_artifact_video( $post_id );
	if ($embed) {
		printf('<div class="embed-responsive embed-responsive-16by9">%s</div>', $embed);
	} else {
		echo get_artifact_image( $post_id );
	}
}

/**
 * Retrieves related artifacts.
 *
 * Returns other artifacts in the same projects as the current artifact.
 *
 * @param  string   $post_id Passed to ACF. Defaults to global $post.
 * @return WP_Query          Artifact query results
 */
function get_related_artifacts( $post_id = null ) {
	if (empty($post_id)) {
		$post_id = get_the_ID();
	}

	$ids = get_field('project', $post_id) ?: -1;

	if (is_array($ids)) {
		$ids = implode(',', $ids);
	}

	return new WP_Query( array(
		'post_type' => 'artifact',
		'post__not_in' => array( $post_id ),
		'meta_query' => array(
			array(
				'key' => 'project',
				'value' => $ids,
				'compare' => 'LIKE'
			)
		)
	));
}

/**
 * Get extension for file.
 *
 * Retrieves attachment extension from ACF file field.
 *
 * @param  string $post_id Passed to ACF. Defaults to global $post.
 * @return string          Uppercased file extension
 */
function get_artifact_filetype( $post_id = null ) {
	if (empty($post_id)) {
		$post_id = get_the_ID();
	}

	if (get_field('file', $post_id)):
		$attachment_id = get_field('file');
		$file = get_attached_file( $attachment_id );
		return strtoupper(wp_check_filetype( $file )['ext']);
	endif;
}

/**
 * Print extension for file. 
 * @see  get_artifact_filetype()
 * @param  string $post_id Passed to ACF. Defaults to null.
 * @return null
 */
function the_artifact_filetype( $post_id = null ) {
	echo get_artifact_filetype( $post_id );
}
