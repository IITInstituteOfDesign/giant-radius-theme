<?php

$artifact = new PostType('Artifact');
$artifact->image = 'dashicons-format-image';
$artifact->supports = array('title', 'author', 'excerpt', 'revisions', 'thumbnail');
$artifact->taxonomies = array('artifact_type', 'topic', 'source', 'post_tag');
