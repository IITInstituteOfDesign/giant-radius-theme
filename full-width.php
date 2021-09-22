<?php
// Template Name: Full-width
// Template Post Type: post, project, course, person, page
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<header class="template_full__header single_header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="single_header__title"><?php the_title(); ?></h1>
					<?php get_template_part('templates/hero-unit') ?>
				</div>
			</div>
		</div>
	</header>

	<main class="template_full__main single_main">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</main>
<?php endwhile; else : ?>
<?php endif; ?>

