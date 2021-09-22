<?php echo $before_widget; ?>
<div class="apply-content <?php echo isset($instance['style']) && $instance['style'] != '' ? $instance['style'] : '' ?>">
	<?php if(isset($instance['subtitle']) && $instance['subtitle'] != ''): ?>
		<h5><?php echo $instance['subtitle']; ?></h5>
	<?php endif; ?>
	<?php if(isset($instance['title']) && $instance['title'] != ''): ?>
		<h2><?php echo $instance['title']; ?></h2>
	<?php endif; ?>
	<?php if(isset($instance['description']) && $instance['description'] != ''): ?>
		<div class="description"><?php echo $instance['description']; ?></div>
	<?php endif; ?>
	<?php if(isset($instance['show_btn']) && $instance['show_btn'] == true): ?>
		<div class="btn-container <?php echo isset($instance['btn_position']) ? $instance['btn_position'] : '' ?> <?php echo isset($instance['btn_offset']) && $instance['btn_offset'] == 1 ? 'offset' : '' ?>">
			<a href="<?php echo isset($instance['btn_url']) ? $instance['btn_url'] : '' ?>" <?php if($instance['url_target']=="1") { ?>target="_blank"<?php } ?> class="custom-btn"><?php echo isset($instance['btn_text']) && $instance['btn_text'] != '' ? $instance['btn_text'] : '' ?></a>
		</div>
	<?php endif; ?>
</div>
<?php echo $after_widget; ?>
