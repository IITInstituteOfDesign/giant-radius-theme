<?php

if (is_post_type_archive() || is_home()):
  $name = get_query_var('post_type');
  if ('any' === $name || empty($name)):
    $name = 'post';
  endif;
  $post_type = get_post_type_object( $name );
  $content = $post_type->description;
  $sidebar = get_option( sprintf('idiit_%s_sidebar', $post_type->name) );
elseif (is_tax() || is_category()):
  $name = get_query_var('term');
  $term = get_term_by('slug', $name, get_query_var('taxonomy'));
  $term_meta = get_option( "taxonomy_term_$term->term_id" );
  $content = category_description();
  $sidebar = isset($term_meta['sidebar']) ? $term_meta['sidebar'] : null;
else:
  $name = get_query_var('post_type');
  $name = empty($name) ? 'post' : $name;
  $content = get_the_content();
endif;

$content = apply_filters('the_content', $content );

?>
              <?php echo $content; ?>