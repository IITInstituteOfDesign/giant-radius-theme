<section class="collection-grid">
  <?php if (have_posts()): ?>
    <div class="cards">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/card', get_query_var('post_type')); ?>
      <?php endwhile; ?>
    </div>
  <?php else : ?>
    <h4><em>No matching results</em></h4>
  <?php endif; ?>
</section>









