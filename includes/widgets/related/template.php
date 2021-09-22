<?php if ($query->have_posts()): ?>
	<?php echo $before_widget; ?>

	<?php echo $before_title . $title . $after_title; ?>

	<ul class="list-unstyled">
		<?php while ($query->have_posts()): $query->the_post(); ?>
			<?php if ($collapse > 0 && $query->current_post == $collapse): ?>
				<li class="media expander">
					<a href="#expand">
						<?php $size = get_image_sizes( 'sidebar' ); ?>
						<div class="media-left">
							<div class="img-placeholder ellipsis" style="width: <?php echo $size['width']; ?>px"></div>
						</div>

						<ul class="media-body list-unstyled">
								<li><?php printf('View %s more...', $query->found_posts - $query->current_post); ?></li>
						</ul>
					</a>
				</li>
			<?php endif; ?>

			<?php $classList = array( 'media' ); ?>
			<?php if ($collapse > 0 && $query->current_post >= $collapse): ?>
				<?php $classList[] = 'hidden'; ?>
			<?php endif; ?>

			<li class="<?php echo implode(' ', $classList); ?>">
				<a <?php post_class(); ?> href="<?php the_permalink(); ?>">
					<?php if (get_field('image') || has_post_thumbnail()): ?>
						<div class="media-left">
							<?php if (get_field('image')): ?>
								<?php echo wp_get_attachment_image( get_field('image'), 'sidebar' ); ?>
							<?php elseif (has_post_thumbnail()): ?>
								<?php the_post_thumbnail( 'sidebar' ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<ul class="media-body list-unstyled">
						<li>
							<?php the_title(); ?>
						</li>
					</ul>
				</a>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>

	<?php echo $after_widget; ?>
<?php endif; ?>
