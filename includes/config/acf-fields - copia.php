<?php


// if(function_exists("register_field_group"))
// {

// 	register_field_group(array (
// 		'id' => 'acf_artifact-details',
// 		'title' => 'Artifact Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54d01b2560a26',
// 				'label' => 'Metadata',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54c2fa7b0e98e',
// 				'label' => 'Stage',
// 				'name' => 'stage',
// 				'type' => 'select',
// 				'choices' => array (
// 					'sketch' => 'Sketch',
// 					'prototype' => 'Prototype',
// 					'deliverable' => 'Deliverable',
// 				),
// 				'default_value' => '',
// 				'allow_null' => 1,
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54af32657dc97',
// 				'label' => 'Type',
// 				'name' => 'artifact_type',
// 				'type' => 'taxonomy',
// 				'required' => 1,
// 				'taxonomy' => 'artifact_type',
// 				'field_type' => 'select',
// 				'allow_null' => 0,
// 				'load_save_terms' => 1,
// 				'return_format' => 'id',
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54b713466aa2a',
// 				'label' => 'File',
// 				'name' => 'file',
// 				'type' => 'file',
// 				'instructions' => 'Books, Presentations',
// 				'save_format' => 'id',
// 				'library' => 'all',
// 			),
// 			array (
// 				'key' => 'field_54b713606aa2d',
// 				'label' => 'URL',
// 				'name' => 'url',
// 				'type' => 'text',
// 				'instructions' => 'Demo, Video',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54c96b4105e26',
// 				'label' => 'Completion Date',
// 				'name' => 'completion_date',
// 				'type' => 'date_picker',
// 				'instructions' => 'Dates you set map to seasons. We recommend defaulting to the first day in each range (e.g. Jan 1st).
// 	<br>January – March = Winter
// 	<br>April – June = Spring
// 	<br>July – August = Summer
// 	<br>October – December = Fall',
// 				'date_format' => 'yymmdd',
// 				'display_format' => 'yy-mm-dd',
// 				'first_day' => 0,
// 			),
// 			array (
// 				'key' => 'field_54d01adf71acb',
// 				'label' => 'Relationships',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54b8619c1e2d6',
// 				'label' => 'Artifacts',
// 				'name' => 'artifact',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'artifact',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_5494dac1b19b3',
// 				'label' => 'Creators',
// 				'name' => 'person',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'featured_image',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_5494db440913d',
// 				'label' => 'Projects',
// 				'name' => 'project',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'project',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54c84c2f8a9f7',
// 				'label' => 'Topics',
// 				'name' => 'topic',
// 				'type' => 'taxonomy',
// 				'taxonomy' => 'topic',
// 				'field_type' => 'checkbox',
// 				'allow_null' => 0,
// 				'load_save_terms' => 1,
// 				'return_format' => 'id',
// 				'multiple' => 0,
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'artifact',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_course-details',
// 		'title' => 'Course Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54d01baf814f8',
// 				'label' => 'Information',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_5494df4353cfd',
// 				'label' => 'Credit Hours',
// 				'name' => 'credit_hours',
// 				'type' => 'text',
// 				'required' => 1,
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54d00ed02c844',
// 				'label' => 'Type',
// 				'name' => 'course_type',
// 				'type' => 'taxonomy',
// 				'taxonomy' => 'course_type',
// 				'field_type' => 'checkbox',
// 				'allow_null' => 1,
// 				'load_save_terms' => 1,
// 				'return_format' => 'id',
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_5494dfac53cff',
// 				'label' => 'Term',
// 				'name' => 'term',
// 				'type' => 'radio',
// 				'required' => 1,
// 				'choices' => array (
// 					'Spring' => 'Spring',
// 					'Summer' => 'Summer',
// 					'Fall' => 'Fall',
// 					'Winter' => 'Winter',
// 				),
// 				'other_choice' => 1,
// 				'save_other_choice' => 0,
// 				'default_value' => '',
// 				'layout' => 'vertical',
// 			),
// 			array (
// 				'key' => 'field_54d01bc5814f9',
// 				'label' => 'Relationships',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_5494df3053cfc',
// 				'label' => 'Instructors',
// 				'name' => 'person',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'featured_image',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d019132844e',
// 				'label' => 'Posts',
// 				'name' => 'post',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'post',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d0193d2844f',
// 				'label' => 'Projects',
// 				'name' => 'project',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'project',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'course',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_definition-details',
// 		'title' => 'Definition Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54d01c0370ca1',
// 				'label' => 'Metadata',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54bff82eee5ea',
// 				'label' => 'Source',
// 				'name' => 'source',
// 				'type' => 'text',
// 				'required' => 1,
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54cbd73ce1081',
// 				'label' => 'Source Date',
// 				'name' => 'source_date',
// 				'type' => 'text',
// 				'required' => 1,
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_5494de66eea7d',
// 				'label' => 'Original Date',
// 				'name' => 'original_date',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_5494dea9eea7e',
// 				'label' => 'Submitted by',
// 				'name' => 'submitted_by',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01bd770ca0',
// 				'label' => 'Relationships',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54d0196f0b4e9',
// 				'label' => 'Definitions',
// 				'name' => 'definition',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'definition',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'definition',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_event-details',
// 		'title' => 'Event Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_5547bd8268b98',
// 				'label' => 'Conference URL',
// 				'name' => 'conference_url',
// 				'type' => 'text',
// 				'instructions' => 'URL to conference microsite (optional)',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01c6921725',
// 				'label' => 'Scheduling',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_5433341ef1801',
// 				'label' => 'Start Date',
// 				'name' => 'start_date',
// 				'type' => 'date_picker',
// 				'required' => 1,
// 				'date_format' => 'yymmdd',
// 				'display_format' => 'dd/mm/yy',
// 				'first_day' => 1,
// 			),
// 			array (
// 				'key' => 'field_54333469f1802',
// 				'label' => 'End Date',
// 				'name' => 'end_date',
// 				'type' => 'date_picker',
// 				'required' => 1,
// 				'date_format' => 'yymmdd',
// 				'display_format' => 'dd/mm/yy',
// 				'first_day' => 1,
// 			),
// 			array (
// 				'key' => 'field_54333478f1803',
// 				'label' => 'Start Time',
// 				'name' => 'start_time',
// 				'type' => 'text',
// 				'conditional_logic' => array (
// 					'status' => 1,
// 					'rules' => array (
// 						array (
// 							'field' => 'field_5433372ba0099',
// 							'operator' => '!=',
// 							'value' => '1',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'default_value' => '',
// 				'placeholder' => '6:00 pm',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'html',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_543334a8f1804',
// 				'label' => 'End Time',
// 				'name' => 'end_time',
// 				'type' => 'text',
// 				'conditional_logic' => array (
// 					'status' => 1,
// 					'rules' => array (
// 						array (
// 							'field' => 'field_5433372ba0099',
// 							'operator' => '!=',
// 							'value' => '1',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'default_value' => '',
// 				'placeholder' => '8:00 pm',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'html',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54381e809fbf5',
// 				'label' => 'RSVP',
// 				'name' => 'rsvp',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => 'http://www.eventbrite.com/e/event-title',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01c5121724',
// 				'label' => 'Venue',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_543334d1f1805',
// 				'label' => 'Name',
// 				'name' => 'venue_name',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => 'IIT Institite of Design',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_543335460dd1a',
// 				'label' => 'Location',
// 				'name' => 'location',
// 				'type' => 'google_map',
// 				'center_lat' => '41.8886845',
// 				'center_lng' => '87.6326337',
// 				'zoom' => 17,
// 				'height' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01c4621723',
// 				'label' => 'Relationships',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_5494ddd871a3a',
// 				'label' => 'Speakers',
// 				'name' => 'person',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'featured_image',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d0199169575',
// 				'label' => 'Posts',
// 				'name' => 'post',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'post',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d019a469576',
// 				'label' => 'Projects',
// 				'name' => 'project',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'project',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'event',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_hero-unit',
// 		'title' => 'Hero Unit',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_549a0367db907',
// 				'label' => 'Slides',
// 				'name' => 'slides',
// 				'type' => 'repeater',
// 				'sub_fields' => array (
// 					array (
// 						'key' => 'field_549a158470284',
// 						'label' => 'Format',
// 						'name' => 'format',
// 						'type' => 'select',
// 						'column_width' => '',
// 						'choices' => array (
// 							'file' => 'File',
// 							'image' => 'Image',
// 							'video' => 'Video',
// 						),
// 						'default_value' => 'image',
// 						'allow_null' => 0,
// 						'multiple' => 0,
// 					),
// 					array (
// 						'key' => 'field_54cc37f182005',
// 						'label' => 'File',
// 						'name' => 'file',
// 						'type' => 'file',
// 						'conditional_logic' => array (
// 							'status' => 1,
// 							'rules' => array (
// 								array (
// 									'field' => 'field_549a158470284',
// 									'operator' => '==',
// 									'value' => 'file',
// 								),
// 							),
// 							'allorany' => 'all',
// 						),
// 						'column_width' => '',
// 						'save_format' => 'id',
// 						'library' => 'all',
// 					),
// 					array (
// 						'key' => 'field_549a15af70285',
// 						'label' => 'Image',
// 						'name' => 'image',
// 						'type' => 'image',
// 						'conditional_logic' => array (
// 							'status' => 1,
// 							'rules' => array (
// 								array (
// 									'field' => 'field_549a158470284',
// 									'operator' => '==',
// 									'value' => 'image',
// 								),
// 							),
// 							'allorany' => 'all',
// 						),
// 						'column_width' => '',
// 						'save_format' => 'id',
// 						'preview_size' => 'thumbnail',
// 						'library' => 'all',
// 					),
// 					array (
// 						'key' => 'field_549a15c570286',
// 						'label' => 'Video URL',
// 						'name' => 'video_url',
// 						'type' => 'text',
// 						'conditional_logic' => array (
// 							'status' => 1,
// 							'rules' => array (
// 								array (
// 									'field' => 'field_549a158470284',
// 									'operator' => '==',
// 									'value' => 'video',
// 								),
// 							),
// 							'allorany' => 'all',
// 						),
// 						'column_width' => '',
// 						'default_value' => 'http://',
// 						'placeholder' => '',
// 						'prepend' => '',
// 						'append' => '',
// 						'formatting' => 'none',
// 						'maxlength' => '',
// 					),
// 				),
// 				'row_min' => '',
// 				'row_limit' => '',
// 				'layout' => 'row',
// 				'button_label' => 'Add Slide',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'page',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'post',
// 					'order_no' => 0,
// 					'group_no' => 1,
// 				),
// 			),
// 			array (
// 				array (
// 					'param' => 'ef_taxonomy',
// 					'operator' => '==',
// 					'value' => 'person_role',
// 					'order_no' => 0,
// 					'group_no' => 2,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 				0 => 'slug',
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_person-details',
// 		'title' => 'Person Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54d01a65324e8',
// 				'label' => 'Contact Info',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_5494dc99877c3',
// 				'label' => 'Email',
// 				'name' => 'email',
// 				'type' => 'email',
// 				'default_value' => '',
// 				'placeholder' => 'user@example.com',
// 				'prepend' => '',
// 				'append' => '',
// 			),
// 			array (
// 				'key' => 'field_5494dcad877c4',
// 				'label' => 'Phone',
// 				'name' => 'phone',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => '123-456-7890',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_5494dd5f877c9',
// 				'label' => 'Links',
// 				'name' => 'links',
// 				'type' => 'repeater',
// 				'sub_fields' => array (
// 					array (
// 						'key' => 'field_5494dd72877ca',
// 						'label' => 'Link',
// 						'name' => 'link',
// 						'type' => 'text',
// 						'required' => 1,
// 						'column_width' => '',
// 						'default_value' => '',
// 						'placeholder' => 'http://www.example.com',
// 						'prepend' => '',
// 						'append' => '',
// 						'formatting' => 'none',
// 						'maxlength' => '',
// 					),
// 				),
// 				'row_min' => '',
// 				'row_limit' => '',
// 				'layout' => 'row',
// 				'button_label' => 'Add Link',
// 			),
// 			array (
// 				'key' => 'field_54d019c9324e1',
// 				'label' => 'Relationships',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54d019f2324e2',
// 				'label' => 'Artifacts',
// 				'name' => 'artifact',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'artifact',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01a02324e3',
// 				'label' => 'Courses',
// 				'name' => 'course',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'course',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01a26324e5',
// 				'label' => 'Events',
// 				'name' => 'event',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'event',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d01a34324e6',
// 				'label' => 'Posts',
// 				'name' => 'post',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'post',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54d5428adf5de',
// 				'label' => 'Other Info',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54e6790101f02',
// 				'label' => 'Designation',
// 				'name' => 'designation',
// 				'type' => 'select',
// 				'choices' => array (
// 					'adjunct' => 'Adjunct',
// 					'emeritus' => 'Emeritus',
// 					'full-time' => 'Full-time',
// 					'distinguished-adjunct' => 'Distinguished Adjunct'
// 				),
// 				'default_value' => '',
// 				'allow_null' => 1,
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54d562d184293',
// 				'label' => 'Degrees',
// 				'name' => 'degrees',
// 				'type' => 'repeater',
// 				'sub_fields' => array (
// 					array (
// 						'key' => 'field_54d562ef84294',
// 						'label' => 'Program',
// 						'name' => 'program',
// 						'type' => 'select',
// 						'column_width' => '',
// 						'choices' => array (
// 							'Bachelor of Science' => 'Bachelor of Science',
// 							'Master of Design' => 'Master of Design',
// 							'Master of Design + MBA' => 'Master of Design + MBA',
// 							'Master of Design Methods' => 'Master of Design Methods',
// 							'Master of Science' => 'Master of Science',
// 							'PhD' => 'PhD',
// 						),
// 						'default_value' => '',
// 						'allow_null' => 1,
// 						'multiple' => 0,
// 					),
// 					array (
// 						'key' => 'field_54d5632a84295',
// 						'label' => 'Term',
// 						'name' => 'term',
// 						'type' => 'select',
// 						'column_width' => '',
// 						'choices' => array (
// 							'spring' => 'Spring',
// 							'summer' => 'Summer',
// 							'fall' => 'Fall',
// 							'winter' => 'Winter',
// 						),
// 						'default_value' => '',
// 						'allow_null' => 0,
// 						'multiple' => 0,
// 					),
// 					array (
// 						'key' => 'field_54d5634784296',
// 						'label' => 'Year',
// 						'name' => 'year',
// 						'type' => 'number',
// 						'column_width' => '',
// 						'default_value' => '',
// 						'placeholder' => '',
// 						'prepend' => '',
// 						'append' => '',
// 						'min' => 1000,
// 						'max' => 9999,
// 						'step' => 1,
// 					),
// 				),
// 				'row_min' => '',
// 				'row_limit' => '',
// 				'layout' => 'table',
// 				'button_label' => 'Add Degree',
// 			),
// 			array (
// 				'key' => 'field_54d56373c478a',
// 				'label' => 'Employment',
// 				'name' => 'employment',
// 				'type' => 'repeater',
// 				'sub_fields' => array (
// 					array (
// 						'key' => 'field_54d56394c478b',
// 						'label' => 'Organization',
// 						'name' => 'organization',
// 						'type' => 'text',
// 						'column_width' => '',
// 						'default_value' => '',
// 						'placeholder' => '',
// 						'prepend' => '',
// 						'append' => '',
// 						'formatting' => 'none',
// 						'maxlength' => '',
// 					),
// 					array (
// 						'key' => 'field_54d5639ec478c',
// 						'label' => 'Position',
// 						'name' => 'position',
// 						'type' => 'text',
// 						'column_width' => '',
// 						'default_value' => '',
// 						'placeholder' => '',
// 						'prepend' => '',
// 						'append' => '',
// 						'formatting' => 'none',
// 						'maxlength' => '',
// 					),
// 				),
// 				'row_min' => '',
// 				'row_limit' => '',
// 				'layout' => 'table',
// 				'button_label' => 'Add Employment',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'person',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_person-name',
// 		'title' => 'Person Name',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54de4abea8e96',
// 				'label' => 'First Name',
// 				'name' => 'first_name',
// 				'type' => 'text',
// 				'required' => 1,
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_54de4acca8e97',
// 				'label' => 'Last Name',
// 				'name' => 'last_name',
// 				'type' => 'text',
// 				'required' => 1,
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'none',
// 				'maxlength' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'person',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'acf_after_title',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_post-details',
// 		'title' => 'Post Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_5499e0e5dd4f2',
// 				'label' => 'Projects',
// 				'name' => 'project',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'project',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'featured_image',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_5499e0ffdd4f3',
// 				'label' => 'People',
// 				'name' => 'person',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'featured_image',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_5499e11edd4f4',
// 				'label' => 'Courses',
// 				'name' => 'course',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'course',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'featured_image',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'post',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_project-details',
// 		'title' => 'Project Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54d01cbd12031',
// 				'label' => 'Metadata',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_5494df0b98289',
// 				'label' => 'Completion Date',
// 				'name' => 'completion_date',
// 				'type' => 'date_picker',
// 				'instructions' => 'Dates you set map to seasons. We recommend defaulting to the first day in each range (e.g. Jan 1st).
// 	<br>January – March = Winter
// 	<br>April – June = Spring
// 	<br>July – August = Summer
// 	<br>October – December = Fall',
// 				'required' => 1,
// 				'date_format' => 'yymmdd',
// 				'display_format' => 'yy-mm-dd',
// 				'first_day' => 0,
// 			),
// 			array (
// 				'key' => 'field_54b70fcb11a73',
// 				'label' => 'Type',
// 				'name' => 'project_type',
// 				'type' => 'taxonomy',
// 				'required' => 1,
// 				'taxonomy' => 'project_type',
// 				'field_type' => 'select',
// 				'allow_null' => 0,
// 				'load_save_terms' => 1,
// 				'return_format' => 'id',
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54b81e838f940',
// 				'label' => 'Theme',
// 				'name' => 'theme',
// 				'type' => 'taxonomy',
// 				'taxonomy' => 'theme',
// 				'field_type' => 'checkbox',
// 				'allow_null' => 0,
// 				'load_save_terms' => 1,
// 				'return_format' => 'id',
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54c014ecc1325',
// 				'label' => 'Topics',
// 				'name' => 'topics',
// 				'type' => 'taxonomy',
// 				'taxonomy' => 'topic',
// 				'field_type' => 'checkbox',
// 				'allow_null' => 0,
// 				'load_save_terms' => 1,
// 				'return_format' => 'id',
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54d01cc612032',
// 				'label' => 'Descriptions',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54c2ebceb6b18',
// 				'label' => 'Assignment',
// 				'name' => 'assignment',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_54c2ecabb6b19',
// 				'label' => 'Synopsis',
// 				'name' => 'synopsis',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_54c2ecbab6b1a',
// 				'label' => 'Problem',
// 				'name' => 'problem',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_54c2eccfb6b1b',
// 				'label' => 'Proposed User Experience',
// 				'name' => 'proposed_user_experience',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_54d01ca712030',
// 				'label' => 'Stages',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54c2ecdfb6b1c',
// 				'label' => 'Sketches',
// 				'name' => 'sketch',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'yes',
// 			),
// 			array (
// 				'key' => 'field_54c2ecfdb6b1d',
// 				'label' => 'Prototypes',
// 				'name' => 'prototype',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'yes',
// 			),
// 			array (
// 				'key' => 'field_54c2ed08b6b1e',
// 				'label' => 'Final Results',
// 				'name' => 'final_result',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'yes',
// 			),
// 			array (
// 				'key' => 'field_54d01c961202f',
// 				'label' => 'Relationships',
// 				'name' => '',
// 				'type' => 'tab',
// 			),
// 			array (
// 				'key' => 'field_54b72541b1d25',
// 				'label' => 'Artifacts',
// 				'name' => 'artifact',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'artifact',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_5494dee898288',
// 				'label' => 'Courses',
// 				'name' => 'course',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'course',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54c964c89b5a0',
// 				'label' => 'People',
// 				'name' => 'person',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_55072323dc16d',
// 				'label' => 'Instructors',
// 				'name' => 'instructor',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_54c015c6f169b',
// 				'label' => 'News',
// 				'name' => 'post',
// 				'type' => 'relationship',
// 				'return_format' => 'id',
// 				'post_type' => array (
// 					0 => 'post',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_type',
// 					1 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'project',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_quote-details',
// 		'title' => 'Quote Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54b6d8c6b069d',
// 				'label' => 'Author',
// 				'name' => 'quote_author',
// 				'type' => 'post_object',
// 				'required' => 1,
// 				'post_type' => array (
// 					0 => 'person',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'allow_null' => 0,
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54b6da63b069e',
// 				'label' => 'Body',
// 				'name' => 'quote_body',
// 				'type' => 'textarea',
// 				'required' => 1,
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'maxlength' => '',
// 				'rows' => '',
// 				'formatting' => 'br',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'quote',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_theme-details',
// 		'title' => 'Theme Details',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54b5d12d9081e',
// 				'label' => 'Image',
// 				'name' => 'image',
// 				'type' => 'image',
// 				'required' => 1,
// 				'save_format' => 'id',
// 				'preview_size' => 'thumbnail',
// 				'library' => 'all',
// 			),
// 			array (
// 				'key' => 'field_54b706a4a001b',
// 				'label' => 'Featured Project',
// 				'name' => 'featured_project',
// 				'type' => 'post_object',
// 				'post_type' => array (
// 					0 => 'project',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'allow_null' => 0,
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_54e5226bdb068',
// 				'label' => 'Slide Layout',
// 				'name' => 'slide_layout',
// 				'type' => 'select',
// 				'choices' => array (
// 					'q1q4' => 'Right',
// 					'q1q2' => 'Top',
// 					'q2q3' => 'Left',
// 					'q3q4' => 'Bottom',
// 				),
// 				'default_value' => 'q3q4',
// 				'allow_null' => 0,
// 				'multiple' => 0,
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'ef_taxonomy',
// 					'operator' => '==',
// 					'value' => 'theme',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_timeline-options',
// 		'title' => 'Timeline Options',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54c1a1a9366ac',
// 				'label' => 'Starting Position',
// 				'name' => 'timeline_starting_position',
// 				'type' => 'radio',
// 				'required' => 1,
// 				'choices' => array (
// 					'left' => 'Left',
// 					'right' => 'Right',
// 				),
// 				'other_choice' => 0,
// 				'save_other_choice' => 0,
// 				'default_value' => 'left',
// 				'layout' => 'vertical',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'page_template',
// 					'operator' => '==',
// 					'value' => 'page-templates/timeline.php',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'side',
// 			'layout' => 'default',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// }
