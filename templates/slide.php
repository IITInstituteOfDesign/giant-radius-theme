<?php if (!(get_sub_field('image') || get_sub_field('file'))): ?>
	<a href="<?php the_permalink(); ?>">
<?php endif; ?>

<figure class="wp-caption">
  <?php idiit_rich_media(); ?>
  <?php if ($caption = idiit_slide_caption()): ?>
  	<figcaption class="wp-caption-text">
  		<?php echo wpautop($caption); ?>
  	</figcaption>
  <?php endif; ?>
</figure>

<?php if (!(get_sub_field('image') || get_sub_field('file'))): ?>
	</a>
<?php endif; ?>
