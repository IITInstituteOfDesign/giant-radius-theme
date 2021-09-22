<?php echo $before_widget; ?>

<?php echo $before_title . $title . $after_title; ?>

<p>
	<?php if (isset($description)): ?>
		<?php echo $description; ?>
	<?php endif; ?>
</p>

<ul class="list-unstyled">
	<?php if ($query->have_posts()): ?>
		<?php while ($query->have_posts()): $query->the_post(); ?>
			<li class="media">
				<a <?php post_class(); ?> href="<?php the_permalink(); ?>">
					<?php if (has_post_thumbnail()): ?>
						<div class="media-left">
							<?php the_post_thumbnail( 'sidebar' ); ?>
						</div>
					<?php else: ?>
						<div class="media-left">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.jpg">
						</div>
					<?php endif; ?>

					<ul class="media-body list-unstyled">
						<h5 class="name"><?php the_title(); ?></h5>


						<?php if (is_object_in_term(get_the_ID(), 'person_role', array('staff','faculty'))): ?>
							<?php while (has_sub_field('employment')): ?>
								<p class="role">
									<?php echo idiit_person_title(); ?>
								</p>
							<?php endwhile; ?>
						<?php elseif (is_object_in_term(get_the_ID(), 'person_role', array('students','alumni'))): ?>
							<?php while (has_sub_field('degrees')): ?>
								<p class="role">
									<?php $output = array( get_sub_field('program') ); ?>
									<?php $output[] = get_sub_field('year'); ?>
									<?php echo implode(', ', array_filter($output)); ?>
								</p>
							<?php endwhile; ?>
						<?php else: ?>
							<?php while (has_sub_field('employment')): ?>
								<p class="role">
									<?php $output = array( get_sub_field('organization') ); ?>
									<?php $output[] = get_sub_field('position'); ?>
									<?php echo implode(', ', array_filter($output)); ?>
								</p>
							<?php endwhile; ?>
						<?php endif; ?>
					</ul>
				</a>
			</li>
		<?php endwhile; ?>
	<?php endif; ?>
</ul>

<?php echo $after_widget; ?>
