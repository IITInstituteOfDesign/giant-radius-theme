<?php while (have_posts()): the_post(); ?>
	<div class="project-row">
		<div class="col-md-12">
			<h2><?php the_title(); ?></h2>
		</div>

		<div class="col-md-6">
			<?php the_excerpt(); ?>

			<a class="btn btn-success" href="<?php the_permalink(); ?>">View Project</a>
		</div>

		<div class="col-md-6">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>

			<?php
				$artifacts = new WP_Query( array(
					'post_type' => 'artifact',
					'meta_query' => array(
						array(
							'key'     => 'project',
						  'value'   =>  get_the_ID(),
						  'compare' => 'LIKE',
						)
					)
				));
			?>

			<?php if ($artifacts->have_posts()): ?>
				<div class="artifacts">
					<?php while ($artifacts->have_posts()): $artifacts->the_post(); ?>
						<?php if ($artifacts->current_post === 5 && $artifacts->found_posts > 6): ?>
							<a class="card" href="#more">
								<div class="content">
									<div class="img-placeholder ellipsis"></div>
	  							<strong><?php printf('%s More Artifacts', $artifacts->found_posts - 5); ?></strong>
								</div>
							</a>

							<div class="collapse">
						<?php endif; ?>

						<?php get_template_part('templates/card', 'project'); ?>

						<?php if ($artifacts->found_posts > 6 && $artifacts->current_post + 1 == $artifacts->found_posts): ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endwhile; ?>
