<?php echo $before_widget; ?>
<?php if (isset($instance['title'])): ?>
	<h4 class="custom-title"><?php echo $instance['title']; ?></h4>
<?php endif; ?>
<?php if (isset($instance['custom_image'])): ?>
	<div class="flexslider js-flexslider-auto">
		<ul class="slides">
			<?php foreach ($instance['custom_image'] as $key => $value): ?>
				<li><img src="<?php echo $value ?>" alt=""></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
<?php echo $after_widget; ?>