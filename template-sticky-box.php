<?php 
// Template Name: Side Sticky Box
// Template Post Type: post, project, course, person, page
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="template_side_sticky">
		<main class="single_post__main single_main js-min-height">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<h1 class="single_header__title"><?php the_title(); ?></h1>
						<?php get_template_part('templates/hero-unit') ?>
						
						<article class="single_post__article single_article" >
							<div class="single_article__style">
								<?php the_content(); ?>
							</div>
						</article>
					</div>
					<div class="col-lg-4">
						<aside>
							<?php if(get_field('sticky_box_title') || get_field('sticky_box_content') || get_field('sticky_box_button')): ?>
								<div class="sticky-box">
									<?php echo null !== get_field('sticky_box_title') && get_field('sticky_box_title') != '' ? '<h4 class="title">'.get_field('sticky_box_title').'</h4>' : '' ?>
									<?php echo null !== get_field('sticky_box_content') && get_field('sticky_box_content') != '' ? get_field('sticky_box_content') : '' ?>
									<?php if (null !== get_field('sticky_box_button') && get_field('sticky_box_button') != ''): ?>
										<a class="custom-btn" href="<?php echo get_field('sticky_box_button')['url'] ?>" target="<?php echo get_field('sticky_box_button')['target'] ?>"><?php echo get_field('sticky_box_button')['title'] ?></a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</aside>
					</div>
				</div>
			</div>
		</main>
	</div>


<?php endwhile; else : ?>
<?php endif; ?>