<?php echo $before_widget; ?>

<?php if ($query->have_posts()): ?>
	<?php while ($query->have_posts()): $query->the_post(); ?>
		<a <?php echo $anchor; ?> <?php post_class(); ?> href="<?php the_permalink(); ?>">
			<?php if (empty($alternate)): ?>
				<header>
					<span class="text-muted">
			      <?php the_tile_metadata(); ?>
			    </span>

					<?php echo $before_title . get_the_title() . $after_title; ?>
				</header>
			<?php endif; ?>

			<?php if (get_the_image() && !empty($description)): ?>
				<?php if (!empty($alternate)): ?>
					<?php the_image(true); ?>
					<div class="description">
						<?php echo wpautop($description); ?>
					</div>
				<?php else: ?>
					<div class="row">
						<div class="col-xs-6">
							<?php the_image(); ?>
						</div>

						<div class="col-xs-6">
							<div class="description ellipsis">
							 	<?php echo wpautop($description); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php elseif (get_the_image()): ?>
				<?php the_image(); ?>
			<?php elseif (!empty($description)): ?>
				<div class="description ellipsis">
					<?php echo wpautop($description); ?>
				</div>
			<?php else: ?>
				<div class="description ellipsis">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>
		</a>
	<?php endwhile; ?>
<?php endif; ?>

<?php echo $after_widget; ?>
