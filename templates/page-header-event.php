<?php $filters = get_query_var('filters'); ?>
<?php ob_start(); ?>
<form action="" method="post" class="filters">
  <ol class="breadcrumb">
    <li>Events</li>
    <li>
      <?php wp_dropdown_categories( array(
        'echo' => true,
        'hierarchical' => true,
        'depth' => 1,
        'show_option_all' => 'All',
        'class' => 'form-control',
        'id' => 'filters-event_type',
        'name' => "filters[event_type]",
        'show_count' => false,
        'taxonomy' => 'event_type',
        'selected' => isset($filters['event_type']) ? $filters['event_type'] : 0
      )); ?>
    </li>
  </ol>
</form>
<?php the_page_header( ob_get_clean() ); ?>
