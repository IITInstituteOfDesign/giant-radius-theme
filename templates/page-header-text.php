<?php
if (is_home()):
  $title = '<h1 class="title newsHead">'.get_the_title( get_option( 'page_for_posts' ) ).'</h1>';
  $title2 = "one";
elseif (is_tax('theme')):
  $title = single_term_title( 'Theme: ', false );
  $title2 = "two";
elseif (is_post_type_archive()):
  $title = post_type_archive_title( '', false );
  $title2 = "three";
elseif (is_archive()):
  $title = single_cat_title( '', false );
  $title2 = "four";
elseif (is_single()):
  $title = get_the_title();
  $title2 = "five";
else:
  $title = '';
  $title2 = "six";
endif;


if($title=="Projects" && is_post_type_archive())
  echo 'Projects';
else
  echo $title;

