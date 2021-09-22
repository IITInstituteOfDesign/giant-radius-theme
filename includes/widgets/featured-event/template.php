<?php echo $before_widget; ?>

<div class="box">
	<article class="content <?php echo (isset($instance['image_size']) && $instance['image_size'] == 'big') ? 'big_image' : '' ?>">	
		<?php if (isset($instance['event_img']) && isset($instance['show_img']) && $instance['show_img'] == true): ?>
			<figure>
				<img src="<?php echo $instance['event_img']; ?>" alt="">
			</figure>
		<?php endif; ?>
		<div class="main-content">
			<?php if ($instance['custom_title'] == true): ?>
				<h3><a href="<?php echo isset($instance['event_url']) ? $instance['event_url'] : '' ?>" target="_blank"><?php echo $instance['custom_title_text']; ?></a></h3>
			<?php else: ?>
				<h3><a href="<?php echo isset($instance['event_url']) ? $instance['event_url'] : '' ?>" target="_blank"><?php echo isset($instance['post']) ? $instance['post'] : ''; ?></a></h3>
			<?php endif; ?>
			<?php if (isset($instance['custom_summary']) && $instance['custom_summary'] == true): ?>
				<p><?php echo $instance['custom_summary_text']; ?></p>
			<?php endif; ?>

			<?php if (isset($instance['show_btn']) && $instance['show_btn'] == true): ?>
				<a class="custom-btn" href="<?php echo isset($instance['event_url']) ? $instance['event_url'] : '' ?>"> <?php echo isset($instance['btn_text']) ? $instance['btn_text'] : '' ?></a>
			<?php endif; ?>
		</div>
	</article>
</div>
<?php echo $after_widget; ?>
