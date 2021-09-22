<?php

$student = new PostType('Student', 'Students', true);
$student->image = 'dashicons-groups';
$student->supports = array('thumbnail');
$student->has_archive = false;

function generate_student_name( $post_id ) {
	//var_dump($post_id);
	//exit;
	if (get_field('first_name', $post_id) && get_field('last_name', $post_id)):
		$name = array( get_field('first_name', $post_id), get_field('last_name', $post_id) );
		$name = implode( ' ', array_filter( $name ));

		//remove_action( 'acf/save_post', 'generate_student_name', 20 );

		wp_update_post( array(
			'ID' => $post_id,
			'post_title' => $name,
		));
	endif;
};

//add_action( 'acf/save_post', 'generate_student_name', 20 );
