<?php 
// Template Name: Full-width Header
// Template Post Type: post, project, course, person, page
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php if (null !== get_field('overlay_color') && get_field('overlay_color') != ''): ?>
		<style>
		.single_post__header.single_header:before{
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 1;
			background-color: <?php the_field('overlay_color') ?>
		}
	</style>
<?php else: ?>
	<style>
	.single_post__header.single_header:before{
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 1;
		background-color: rgba(54, 57, 76, 0.45);
	}
</style>
<?php endif; ?>
<div class="template_full_width_header">
	<header class="single_post__header single_header">
		<?php if (has_post_thumbnail()): ?>
			<img class="featured_image <?php echo null !== get_field('grey_filter_image') && get_field('grey_filter_image') == true ? 'duo' : ''; ?>" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>" alt="<?php echo get_the_title() ?>">
		<?php endif ?>
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1 col-flex">
					<h1 class="single_header__title" style="color: <?php null !== get_field('title_color') && get_field('title_color') != '' ? the_field('title_color') : '#fff'; ?>"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</header>
	<?php if (get_field('slides')): ?>
		<div class="single_post__slider">
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<?php get_template_part('templates/hero-unit') ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<main class="single_post__main single_main">
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<article class="single_post__article single_article">
						<div class="single_article__style">
							<?php the_content(); ?>
						</div>
						<?php get_template_part('templates/artifacts') ?>
					</article>
				</div>
			</div>
		</div>
	</main>
</div>


<?php endwhile; else : ?>
<?php endif; ?>