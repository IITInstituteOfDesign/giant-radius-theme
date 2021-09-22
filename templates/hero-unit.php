<?php if (get_field('slides')): ?>
	<figure class="single_header__slider">
		<div class="js_hero_unit hero_unit">
			<?php while ( have_rows('slides') ) : the_row(); ?>
				<div class="hero_unit__item">
					<?php if (get_sub_field('format') == 'image'): ?>
						<figure class="slider_image">
							<?php if (get_sub_field('image_link')): ?>
								<a href="<?php the_sub_field('image_link') ?>" target="_blank">
							<?php endif; ?>
							<?php echo wp_get_attachment_image(get_sub_field('image'), 'carousel') ?>
							<?php //if (get_post_field('post_excerpt', get_sub_field('image'))): ?>
							<?php if (get_sub_field('image_subtitle') || get_sub_field('image_title')): ?>
							<figcaption class="wp-caption-text">
								<?php //echo wpautop(get_post_field('post_excerpt', get_sub_field('image'))); ?>
								<h3><?php the_sub_field('image_title'); ?></h3>
								<?php the_sub_field('image_subtitle'); ?>
							</figcaption>
						<?php endif; ?>
						<?php if (get_sub_field('image_link')): ?>
							</a>
						<?php endif; ?>
					</figure>
				<?php elseif(get_sub_field('format') == 'file'):
					$file = get_attached_file( get_sub_field('file') );
					$ext = wp_check_filetype( $file )['ext'];
					?>
					<?php if ($ext == 'svg' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp'): ?>
						<figure class="slider_image">
							<?php if (get_sub_field('image_link')): ?>
								<a href="<?php the_sub_field('image_link') ?>" target="_blank">
							<?php endif; ?>
							<img src="<?php echo wp_get_attachment_url( get_sub_field('file') ); ?>" alt="">
							<?php if (get_sub_field('image_subtitle') || get_sub_field('image_title')): ?>
							<figcaption class="wp-caption-text">
								<?php //echo wpautop(get_post_field('post_excerpt', get_sub_field('image'))); ?>
								<h3><?php the_sub_field('image_title'); ?></h3>
								<?php the_sub_field('image_subtitle'); ?>
							</figcaption>
						<?php endif; ?>
						<?php if (get_sub_field('image_link')): ?>
							</a>
						<?php endif; ?>
					</figure>
					<?php else: ?>
						<figure class="slider_file" style="<?php echo get_sub_field('file_preview_image') ? 'background-image: url('.get_sub_field('file_preview_image')['sizes']['large'].')' : ''; ?>">
							<a href="<?php echo wp_get_attachment_url( get_sub_field('file') ); ?>" class="file_container">
								<div class="file_container__icon">
									<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M18 18H2V2h5v11.58l-2.53-2.42-1.35 1.45 4.95 4.67 4.9-4.67-1.36-1.45L9 13.58V2h3v6h6v10zM14 0H0v20h20V6.2L14 0z" fill-rule="evenodd"/></svg>
								</div>
								<div class="file_container__data">
									<b>Download File:</b>
									<h5><?php the_sub_field('filename') ?></h5>
									<!-- <h5><?php // echo get_the_title(get_sub_field('file')) ?></h5> -->
									<!-- <h6 class="filename"><?php// echo wp_basename(wp_get_attachment_url( get_sub_field('file') )) ?></h6> -->
								</div>
							</a>
						</figure>
					<?php endif ?>
					<?php elseif(get_sub_field('format') == 'video'):  ?>
						<figure class="slider_video">
							<?php idiit_rich_media(); ?>
						</figure>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
	</figure>
	<?php elseif(has_post_thumbnail()): ?>
		<figure class="single_header__featured">
			<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>" alt="">
			<?php if (get_post_field('post_excerpt', get_sub_field('image'))): ?>
				<figcaption class="wp-caption-text">
					<?php echo wpautop(get_post_field('post_excerpt', get_sub_field('image'))); ?>
				</figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; 
        $slick_settings = get_field('slider_settings'); ?>
