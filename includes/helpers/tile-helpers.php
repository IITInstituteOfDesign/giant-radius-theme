<?php

/**
 * Generates list of metadata attributes for a tile.
 * @return array List of metadata strings.
 */
function get_tile_metadata() {
  $metadata = array();
  $id = get_the_ID();
  $post_type = get_post_type();

  switch ($post_type) {
  	case 'artifact':
  		$terms = wp_get_post_terms( $id, 'artifact_type' );
  		$terms = wp_list_pluck( $terms, 'name' );
  		$metadata = array_merge( $metadata, $terms );
  		break;
  	case 'person':
  		$terms = wp_get_post_terms( $id, 'person_role' );
  		$terms = wp_list_pluck( $terms, 'name' );
  		$metadata = array_merge( $metadata, $terms );
  		break;
  	case 'post':
  		$terms = get_the_category( $id );
  		$terms = wp_list_pluck( $terms, 'name' );
  		$metadata = array_merge( $metadata, $terms );
  		break;
  	case 'project':
  		$terms = wp_get_post_terms( $id, 'project_type' );
  		$terms = wp_list_pluck( $terms, 'name' );
  		$metadata = array_merge( $metadata, $terms );
  		break;
  	default:
  		$obj = get_post_type_object( $post_type );
			$metadata[] = $obj->labels->singular_name;
  }

  return array_filter($metadata);
}

/**
 * Prints list of metadata attributes for a tile.
 * @param  string $sep String to join list items.
 * @return null
 */
function the_tile_metadata( $sep = ', ' ) {
  echo implode( $sep, get_tile_metadata() );
}