<?php

$course = new PostType('Course');
$course->image = 'dashicons-welcome-learn-more';
$course->taxonomies = array('course_type', 'post_tag');

