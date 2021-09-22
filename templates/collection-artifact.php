<?php if (empty(get_query_var('filters'))): ?>
  <?php $terms = get_terms('artifact_type'); ?>
  <?php foreach ($terms as $term): ?>
    <?php
      $args = filtered_query( array(
        'post_type' => get_query_var( 'post_type' ),
        'posts_per_page' => 12,
        'tax_query' => array(
          array(
            'taxonomy' => 'artifact_type',
            'terms' => $term->term_id
          )
        )
      ));

      $artifacts = new WP_Query($args);
    ?>

    <section>
      <h2><?php printf( 'Latest %s', $term->name); ?></h2>
      <div class="row">
        <div class="flexslider inline" data-slideshow="false">
          <ul class="slides">
            <?php while ($artifacts->have_posts()) : $artifacts->the_post(); ?>
              <li><?php get_template_part('templates/card', get_query_var('post_type')); ?></li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    </section>
  <?php endforeach; ?>
<?php else: ?>
  <?php get_template_part('templates/collection'); ?>
<?php endif; ?>
