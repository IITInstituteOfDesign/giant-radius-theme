<?php echo $before_widget; ?>
<?php if (isset($instance['title'])): ?>
	<h4 class="custom-title"><?php echo $instance['title']; ?></h4>
<?php endif; ?>
<?php if ($instance['custom_title']): ?>
	<?php foreach ($instance['custom_title'] as $key => $value):?>
		<article class="item">	
			<figure>
				<?php echo isset($instance['custom_url'][$key]) && $instance['custom_url'][$key] != '' ? '<a href="'.$instance['custom_url'][$key].'">' : ''?>
				<div class="img-container" style="<?php echo isset($instance['custom_image'][$key]) && $instance['custom_image'][$key] != '' ? 'background-image:url('.$instance['custom_image'][$key].')' : 'background-image:url('.get_template_directory_uri().'/assets/img/no-image.svg'.')' ?>"></div>
				<?php echo isset($instance['custom_url'][$key]) && $instance['custom_url'][$key] != '' ? '</a>' : ''?>
			</figure>
			<div class="main-content">
				<?php echo isset($instance['custom_url'][$key]) && $instance['custom_url'][$key] != '' ? '<a href="'.$instance['custom_url'][$key].'">' : ''?>
				<h3><?php echo $instance['custom_title'][$key] ?></h3>
				<?php echo isset($instance['custom_url'][$key]) && $instance['custom_url'][$key] != '' ? '</a>' : ''?>
				<p><?php echo $instance['custom_summary'][$key] ?></p>
			</div>
		</article>
	<?php endforeach; ?>
<?php endif; ?>



<?php echo $after_widget; ?>
