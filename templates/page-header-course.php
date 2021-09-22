<?php ob_start(); ?>
<div class="filters">
  <ol class="breadcrumb">
    <li>Courses</li>
    <li>
      <div class="dropdown">
        <button type="button" data-toggle="dropdown">
          <?php $slug = get_query_var('term'); ?>
          <?php if (empty($slug)): ?>
            <?php $current = 'All'; ?>
          <?php else: ?>
            <?php $term = get_term_by( 'slug', $slug, 'course_type' ); ?>
            <?php $current = $term->name; ?>
          <?php endif; ?>

          <?php echo $current; ?>
          <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
          <?php
            $classes = array();
            if (is_post_type_archive('course')) {
              $classes[] = 'current-cat';
            }
          ?>
          <li class="<?php echo implode(' ', $classes); ?>"><a href="<?php echo get_post_type_archive_link('course'); ?>">All</a></li>
          <?php wp_list_categories( array(
            'echo' => true,
            'title_li' => '',
            'orderby' => 'slug',
            'hierarchical' => true,
            'depth' => 1,
            'show_count' => false,
            'taxonomy' => 'course_type'
          )); ?>
        </ul>
      </div>
    </li>
  </ol>
</div>
<?php the_page_header( ob_get_clean() ); ?>
