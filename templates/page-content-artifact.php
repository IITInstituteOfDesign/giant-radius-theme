<?php if (is_single()): ?>
	<section><?php get_template_part('templates/metadata', get_post_type()); ?></section>

	<?php if (has_excerpt()): ?>
		<section id="page-description">
			<div class="column">
				<?php the_excerpt(); ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if (get_field('project')): ?>
		<?php $projects = new WP_Query( array( 'post_type' => 'any', 'post__in' => get_field('project') ) ); ?>
		<?php if ($projects->have_posts()): ?>
			<section>
				<h4>Projects this artifact belongs to</h4>
				<div class="cards">
					<?php while($projects->have_posts()): $projects->the_post(); ?>
						<?php get_template_part('templates/card', get_query_var('post_type')); ?>
					<?php endwhile; ?>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (get_field('person')): ?>
		<?php
			$people = new WP_Query( array(
				'post_type' => 'any',
				'post__in'  => get_field('person'),
				'meta_key'  => 'last_name',
				'orderby'   => 'meta_value',
				'order'     => 'ASC'
			));
		?>
		<?php if ($people->have_posts()): ?>
			<section>
				<h4>People involved in this artifact</h4>
				<div class="cards">
					<?php while($people->have_posts()): $people->the_post(); ?>
						<?php get_template_part('templates/card', get_query_var('post_type')); ?>
					<?php endwhile; ?>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php $artifacts = get_related_artifacts(); ?>
	<?php if ($artifacts->have_posts()): ?>
		<section>
			<h4>Additional artifacts from this project</h4>
			<div class="cards">
				<?php while($artifacts->have_posts()): $artifacts->the_post(); ?>
					<?php get_template_part('templates/card', get_query_var('post_type')); ?>
				<?php endwhile; ?>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php if (get_field('project')): ?>
		<?php $projects = get_related_projects(); ?>
		<?php if ($projects->have_posts()): ?>
			<section>
				<h4>Explore related projects</h4>
				<div class="cards">
					<?php while($projects->have_posts()): $projects->the_post(); ?>
						<?php get_template_part('templates/card', get_query_var('post_type')); ?>
					<?php endwhile; ?>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endif; ?>
<?php else: ?>
	<?php get_template_part('templates/page-content'); ?>
<?php endif; ?>
