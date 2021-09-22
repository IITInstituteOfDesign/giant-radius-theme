<?php 
// Template Name: Full-width Header + Sticky Box
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
<div class="template_full_width_sticky">
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
	<main class="single_post__main single_main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<?php if (get_field('slides')): ?>
						<div class="single_post__slider">
							<figure class="single_header__slider">
								<div class="js-flexslider flexslider js-flexslider-equal">
									<ul class="slides">
										<?php while ( have_rows('slides') ) : the_row(); ?>
											<li>
												<?php if (get_sub_field('format') == 'image'): ?>
													<figure class="slider_image">
														<?php echo wp_get_attachment_image(get_sub_field('image'), 'carousel') ?>
													</figure>
												<?php elseif(get_sub_field('format') == 'file'):  ?>
													<figure class="slider_file" style="<?php echo has_post_thumbnail() == true ? 'background-image: url('.get_the_post_thumbnail_url(get_the_ID(), 'carousel').')' : ''; ?>">
														<a href="<?php echo wp_get_attachment_url( get_sub_field('file') ); ?>" class="file_container">
															<div class="file_container__icon">
																<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M18 18H2V2h5v11.58l-2.53-2.42-1.35 1.45 4.95 4.67 4.9-4.67-1.36-1.45L9 13.58V2h3v6h6v10zM14 0H0v20h20V6.2L14 0z" fill-rule="evenodd"/></svg>
															</div>
															<div class="file_container__data">
																<b>Download File:</b>
																<h5><?php echo get_the_title(get_sub_field('file')) ?></h5>
																<h6 class="filename"><?php echo wp_basename(wp_get_attachment_url( get_sub_field('file') )) ?></h6>
															</div>
														</a>
													</figure>
												<?php elseif(get_sub_field('format') == 'video'):  ?>
													<figure class="slider_video">
														<?php idiit_rich_media(); ?>
													</figure>
												<?php endif; ?>
											</li>
										<?php endwhile; ?>
									</ul>
								</div>
							</figure>

						</div>
					<?php endif; ?>
					<article class="single_post__article single_article">
						<div class="single_article__style">
							<?php the_content(); ?>
						</div>
						<?php get_template_part('templates/artifacts') ?>
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