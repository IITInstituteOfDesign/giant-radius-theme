<?php if (is_single()): ?>
  <?php get_template_part('templates/slide'); ?>
<?php else: ?>
  <div <?php post_class(); ?>>
    <figure class="wp-caption">
      <?php idiit_rich_media(); ?>
    	<figcaption class="wp-caption-text q3q4">
        <div class="slide-title">
          <h2><?php the_title(); ?></h2>
          <time datetime="<?php the_short_date(); ?>">
            <?php the_long_date(); ?>
          </time>
        </div>

        <div class="slide-subhead">
          <p>
            <?php echo get_the_excerpt(); ?>
            <br><a href="<?php the_permalink(); ?>">Learn More</a>
          </p>
        </div>
      </figcaption>
    </figure>
  </div>
<?php endif; ?>
