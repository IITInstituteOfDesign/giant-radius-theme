<a class="<?php the_filmstrip_class_list(); ?>" href="<?php the_permalink(); ?>">
  <div class="media">
    <div class="media-left">
      <?php $args = array( 'class' => 'media-object' ); ?>
      <?php if (get_field('image')): ?>
        <?php echo wp_get_attachment_image( get_field('image'), 'sidebar-big', false, $args ); ?>
      <?php elseif (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('sidebar-big', $args ); ?>
      <?php endif; ?>
    </div>

    <div class="media-body">
      <?php the_title(); ?>
    </div>
  </div>
</a>