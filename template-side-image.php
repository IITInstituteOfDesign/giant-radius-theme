<?php 
// Template Name: Side Featured Image
// Template Post Type: post, project, course, person, page
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="template_side_image">
		<main class="single_post__main single_main  js-min-height">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
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
						<?php elseif (has_post_thumbnail()): ?>
							<img class="featured_image <?php echo null !== get_field('grey_filter_image') && get_field('grey_filter_image') == true ? 'duo' : ''; ?>" src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>" alt="<?php echo get_the_title() ?>">
						<?php endif ?>
					</div>
					<div class="col-lg-6">
						<article class="single_post__article single_article" >
							<h1 class="single_header__title"><?php the_title(); ?></h1>
							<div class="single_article__style">
								<?php the_content(); ?>
							</div>
						</article>
					</div>
				</div>
			</div>
		</main>
	</div>


<?php endwhile; else : ?>
<?php endif; ?>