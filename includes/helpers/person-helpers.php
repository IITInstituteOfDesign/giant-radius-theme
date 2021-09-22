<?php 

/**
 * Returns the first person_role term assigned to a given person
 * @param  object $person Person post object.
 * @return string         Role name.
 */
function role( $person ) {
	$roles = get_the_terms( $person->ID , 'person_role' );
	if (is_array($roles) && !empty($roles)) {
		return $roles[0]->name;
	} else {
		return '';
	}
}

/**
 * Returns employment title with optional organization name if outside of ID.
 * @param  string $sep Separator for array implode.
 * @return string      Concatenated title and organization.
 */
function idiit_person_title( $sep = ', ' ) {
	$output = array();
	$output[] = get_sub_field('position');
	if (get_sub_field('organization') !== 'IIT Institute of Design'):
		$output[] = get_sub_field('organization');
	endif;
	return implode( $sep, array_filter( $output ) );
}
