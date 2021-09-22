<?php if (!is_singular('definition')): ?>
  <a href="<?php the_permalink(); ?>">
<?php endif; ?>

<blockquote class="definition-big">
  <?php the_content(); ?>
  <?php $citation = array( get_the_title() ); ?>

  <cite>
    <?php if (get_field('original_date') && get_field('original_date') !== get_field('source_date')): ?>
      <strong><?php the_title(); ?>, <?php the_field('original_date'); ?></strong>
    <?php else: ?>
      <strong><?php the_title(); ?></strong>
    <?php endif; ?>

    <?php if (get_field('source')): ?>
      <br>Source: <?php the_field('source'); ?>
    <?php endif; ?>

    <?php if (get_field('source_date')): ?>
      <?php the_field('source_date'); ?>
    <?php endif; ?>
  </cite>
</blockquote>

<?php if (!is_singular('definition')): ?>
  </a>
<?php endif; ?>
