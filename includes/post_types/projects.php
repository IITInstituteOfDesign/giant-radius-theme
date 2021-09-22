<?php

$project = new PostType('Project');
$project->image = 'dashicons-book-alt';
$project->supports[] = 'thumbnail';
$project->taxonomies = array('project_type', 'theme', 'topic', 'post_tag');
