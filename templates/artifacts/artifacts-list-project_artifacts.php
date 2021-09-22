
	<section class="artifact-list">
		<ul>
			<?php foreach (get_field('project_artifacts') as $key => $value): ?>
				<?php if ($value['artifact_file']):
				$file = get_attached_file( $value['artifact_file'] );
				$ext = wp_check_filetype( $file )['ext'];
				?>
				<?php if ($ext == 'svg' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp'): ?>
					<li class="image">
						<a href="<?php echo wp_get_attachment_image_url($value['artifact_file'], 'carousel') ?>">
						<figure class="thumbnail">
							<img src="<?php echo wp_get_attachment_image_src($value['artifact_file'], 'thumbnail')[0] ? wp_get_attachment_image_src($value['artifact_file'], 'thumbnail')[0] : get_template_directory_uri().'/assets/img/no-image.svg'; ?>" alt="">
						</figure>
						<div class="content">
						  <h6><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></h6>
						  <p>View Image</p>
					  </div>
					  </a>
					</li>
				<?php else: ?>
					<li class="file">
						<a href="<?php echo wp_get_attachment_url( $value['artifact_file'] ); ?>">
							<figure class="thumbnail">
								<img src="<?php echo wp_get_attachment_image_src($value['artifact_image'], 'thumbnail')[0] ? wp_get_attachment_image_src($value['artifact_image'], 'thumbnail')[0] : get_template_directory_uri().'/assets/img/no-image.svg'; ?>" alt="">
							</figure>
						  <div class="content">
						  	<h6><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></h6>
						  	<p>View File</p>
						  </div>
					  </a>
					</li>
				<?php endif; ?>
			<?php elseif ($value['artifact_url']): ?>
				<?php if (false !== strpos($value['artifact_url'], 'vimeo.com')):
				if (preg_match('/\d+/', $value['artifact_url'], $matches)) {
					$value['artifact_url'] = add_query_arg( array( 'api' => 1, 'player_id' => "v{$matches[0]}" ), $value['artifact_url'] );
					$value['artifact_url'] = str_replace( array( 'https://vimeo.com', 'http://vimeo.com' ), '//player.vimeo.com/video', $value['artifact_url'] );
				}
				?>

			<?php else: ?>
				<li class="url">
					<a href="<?php echo $value['artifact_url']; ?>">
						<figure class="thumbnail">
							<img src="<?php echo $value['artifact_image'] ? wp_get_attachment_image_src($value['artifact_file'][0], 'thumbnail') : get_template_directory_uri().'/assets/img/no-image.svg'; ?>" alt="">
						</figure>
						<div class="content">
							<h6><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></h6>
							<p>Open link</p>
						</div>
						</a>
				</li>
			<?php endif; ?>
		<?php else: ?>
			<li class="image">
					<a href="<?php echo wp_get_attachment_image_url($value['artifact_image'], 'carousel') ?>">
					<figure class="thumbnail">
						<img src="<?php echo wp_get_attachment_image_src($value['artifact_image'], 'thumbnail')[0] ? wp_get_attachment_image_src($value['artifact_image'], 'thumbnail')[0] : get_template_directory_uri().'/assets/img/no-image.svg'; ?>" alt="">
					</figure>
					<div class="content">
						<h6><?php echo $value['artifact_title'] ? $value['artifact_title'] : ''; ?></h6>
						<p>View Image</p>
					</div>
				</a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
	</section>
