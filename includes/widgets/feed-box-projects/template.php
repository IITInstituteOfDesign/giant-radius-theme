<?php echo $before_widget; ?>

<div class="articles-container">
	<?php if ( $query->have_posts() ) : ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<a href="<?php the_permalink(); ?>"><article>
				<?php if (has_post_thumbnail(get_the_ID())): ?>
					<img class="duo" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'card') ?>">
				<?php endif; ?>
				<h3><?php the_title(); ?></h3>
			</article></a>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>

<?php echo $after_widget; ?>
