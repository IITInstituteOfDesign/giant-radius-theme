<?php echo $before_widget; ?>

<article class="content <?php echo (isset($instance['image_size']) && $instance['image_size'] == 'big') ? 'big_image' : '' ?>">	
	<?php if ($instance['show_img'] == true && $instance['image'] != ''): ?>
		<figure>
			<img src="<?php echo isset($instance['image']) ? $instance['image'] : '' ?>" alt="">
		</figure>
	<?php endif; ?>
	<div class="main-content">
		<?php echo isset($instance['title']) ? '<h3>'.$instance['title'].'</h3>' : '' ?>
		<?php echo isset($instance['summary']) ? '<p>'.$instance['summary'].'</p>' : '' ?>
		<?php if (isset($instance['show_btn']) && $instance['show_btn'] == true): ?>
			<a <?php echo (isset($instance['btn_target']) && $instance['btn_target'] == true) ? 'target="_blank"' : '' ?> href="<?php echo isset($instance['btn_url']) ? $instance['btn_url'] : '' ?>" class="custom-btn"><?php echo isset($instance['btn_text']) ? $instance['btn_text'] : '' ?></a>
		<?php endif ?>
	</div>
</article>


<?php echo $after_widget; ?>
