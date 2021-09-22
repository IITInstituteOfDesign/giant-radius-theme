<?php echo $before_widget; ?>

<?php if ($instance['btn_custom_title'] == true): ?>
	<h1 class="title"><?php echo $instance['custom_title'] ?></h1>
<?php else: ?>
	<h1 class="title"><?php the_title(); ?></h1>
<?php endif; ?>

<?php echo $after_widget; ?>
