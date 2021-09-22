<?php echo $before_widget; ?>

<?php if (isset($instance['title'])): ?>
	<h4 class="custom-title"><?php echo $instance['title']; ?></h4>
<?php endif; ?>

<?php if ($instance['custom_title']): ?>
	<?php foreach ($instance['custom_title'] as $key => $value):?>
		<?php if ($instance['custom_url'][$key]):?>
			<article class="item">	
				<?php
				if (isset($instance['custom_image'][$key]) && $instance['custom_image'][$key] != '') {
					$ext = pathinfo($instance['custom_image'][$key])['extension'];
					$base = basename($instance['custom_image'][$key]);
					if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp' || $ext == 'svg') {
						$is_image = true;
					}else{
						$is_image = false;
					}
				}else{
					$is_image = false;
				}
				?>
				<figure>
					<div class="img-container <?php echo isset($instance['custom_image'][$key]) && $instance['custom_image'][$key] != '' && $is_image == true ? '' : 'bg-icon' ?>" style="<?php echo isset($instance['custom_image'][$key]) && $instance['custom_image'][$key] != '' && $is_image == true ? 'background-image:url('.$instance['custom_image'][$key].')' : 'background-image:url('.get_template_directory_uri().'/assets/img/icn-url.svg)' ?>"></div>
				</figure>
				<div class="main-content">
					<h3><?php echo $instance['custom_title'][$key] ?></h3>
					<p><?php echo $instance['custom_summary'][$key] ?></p>
					<a href="<?php echo $instance['custom_url'][$key] ?>" target="_blank"><span>Open Link</span></a>
				</div>
			</article>
			<?php elseif ($instance['custom_image'][$key]): ?>
				<article class="item">
					<?php
					$ext = pathinfo($instance['custom_image'][$key])['extension'];
					$base = basename($instance['custom_image'][$key]);
					if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp' || $ext == 'svg') {
						$is_image = true;
					}else{
						$is_image = false;
					}
					?>
					<figure>
						<div class="img-container <?php echo !$is_image ? 'bg-icon' : '' ?>" style="<?php echo $is_image == true ? 'background-image:url('.$instance['custom_image'][$key].')' : 'background-image:url('.get_template_directory_uri().'/assets/img/icn-file-download.svg)' ?>"></div>
					</figure>
					<div class="main-content">
						<h3><?php echo $instance['custom_title'][$key] ?></h3>
						<p><?php echo $instance['custom_summary'][$key] ?></p>
						<?php if (!$is_image): ?>
							<a href="<?php echo $instance['custom_image'][$key] ?>" target="_blank"><span>View File</span></a>
							<?php else: ?>
								<a href="<?php echo $instance['custom_image'][$key] ?>" target="_blank"><span>Open Image</span></a>
							<?php endif; ?>
						</div>
					</article>
				<?php endif; ?>

			<?php endforeach; ?>
		<?php endif; ?>



		<?php echo $after_widget; ?>
