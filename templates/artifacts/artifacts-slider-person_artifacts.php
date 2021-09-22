
	<br>
	<div class="flexslider js-flexslider-auto js-flexslider-equal artifact-slider">
		<ul class="slides">
			<?php foreach (get_field('person_artifacts') as $key => $value): ?>
				<?php if ($value['artifact_file']):
				$file = get_attached_file( $value['artifact_file'] );
				$ext = wp_check_filetype( $file )['ext'];
				?>
				<?php if ($ext == 'svg' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp'): ?>
					<li class="image">
						<span class="image--caption"><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></span>
						<?php echo wp_get_attachment_image($value['artifact_file'], 'carousel') ?>
					</li>
				<?php else: ?>
					<li class="file">
						<figure style="<?php echo $value['artifact_image'] ? 'background-image: url('.wp_get_attachment_image_src($value['artifact_image'], 'carousel')[0].')' : ''; ?>">
							<a href="<?php echo wp_get_attachment_url( $value['artifact_file'] ); ?>" class="file_container">
								<div class="file_container__icon">
									<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M18 18H2V2h5v11.58l-2.53-2.42-1.35 1.45 4.95 4.67 4.9-4.67-1.36-1.45L9 13.58V2h3v6h6v10zM14 0H0v20h20V6.2L14 0z" fill-rule="evenodd"/></svg>
								</div>
								<div class="file_container__data">
									<b>Download File:</b>
									<h5><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></h5>
									<h6 class="filename"><?php echo wp_basename(wp_get_attachment_url( $value['artifact_file'] )) ?></h6>
								</div>
							</a>
						</figure>
					</li>
				<?php endif; ?>
			<?php elseif ($value['artifact_url']): ?>
				<?php if (false !== strpos($value['artifact_url'], 'vimeo.com')):
				if (preg_match('/\d+/', $value['artifact_url'], $matches)) {
					$value['artifact_url'] = add_query_arg( array( 'api' => 1, 'player_id' => "v{$matches[0]}" ), $value['artifact_url'] );
					$value['artifact_url'] = str_replace( array( 'https://vimeo.com', 'http://vimeo.com' ), '//player.vimeo.com/video', $value['artifact_url'] );
				}
				?>
				<li class="video">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="<?php echo $value['artifact_url'] ?>" width="100%" height="640" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				</li>
			<?php else: ?>
				<li class="url">
					<figure style="<?php echo $value['artifact_image'] ? 'background-image: url('.wp_get_attachment_image_src($value['artifact_image'], 'carousel')[0].')' : ''; ?>">
						<a href="<?php echo $value['artifact_url'] ?>" target="_blank" class="url_container">
							<div class="file_container__icon">
								<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M18.24 1.76a6.01 6.01 0 0 0-8.5 0L7.16 4.33l1.41 1.42 2.57-2.57a4 4 0 1 1 5.67 5.67l-2.57 2.57 1.42 1.41 2.57-2.56a6.01 6.01 0 0 0 0-8.5zm-9.4 15.06a3.98 3.98 0 0 1-5.66 0 4.01 4.01 0 0 1 0-5.67l2.57-2.57-1.42-1.42-2.57 2.57a6.01 6.01 0 0 0 8.5 8.5l2.58-2.56-1.42-1.42-2.57 2.57zm3.42-10.5l1.42 1.42-5.96 5.96-1.42-1.42 5.96-5.96z" fill-rule="evenodd"/></svg>
							</div>
							<div class="file_container__data">
								<b>Open Link:</b>
								<h5><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></h5>
							</div>
						</a>
					</figure>
				</li>
			<?php endif; ?>
		<?php else: ?>
			<li class="image">
				<span class="image--caption"><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></span>
				<?php echo wp_get_attachment_image($value['artifact_image'], 'carousel') ?>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
</div>
