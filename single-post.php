<?php if ( have_posts() ) : while ( have_posts() ) :
	the_post();
	$slider = get_field('slides');
	?>
	<main class="project_template">
		<header class="project_template__header" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>')">
			<?php if ($slider): ?>
				<?php get_template_part('templates/hero-unit') ?>
				<?php else: ?>
					<div class="container">
						<div class="row">
							<div class="col-lg-8 offset-lg-2">
								<h1 class="header_title"><?php the_title(); ?></h1>
								<?php if (has_excerpt(get_the_ID())): ?>
									<div class="header_summary"><?php the_excerpt(); ?></div>
									<?php else: ?>
										<div class="header_summary"></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</header>
				<section class="project_template__main single_main">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 offset-lg-2">
								<article class="single_project__article single_article">
									<?php if ($slider): ?>
										<h1 class="single_project__article-title"><?php the_title(); ?></h1>
									<?php endif; ?>
									<div class="single_article__style">
										<?php the_content(); ?>
										<?php get_template_part('templates/artifacts') ?>
									</div>
								</article>
							</div>
						</div>
					</div>
				</section>
			</main>
		<?php endwhile; else : ?>
	<?php endif; ?>
