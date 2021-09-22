<?php
// Template Name: Full-width Empty
// Template Post Type: post, project, course, person, page
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<main class="template_full__clean single_main">
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