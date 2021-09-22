<?php
if (is_home()):
  $title = get_the_title( get_option( 'page_for_posts' ) );
elseif (is_tax('theme')):
  $title = single_term_title( 'Theme: ', false );
elseif (is_post_type_archive()):
  $title = post_type_archive_title( '', false );
elseif (is_archive()):
  $title = single_cat_title( '', false );
elseif (is_single()):
  $title = get_the_title();
else:
  $title = '';
endif;

the_page_header( $title );
