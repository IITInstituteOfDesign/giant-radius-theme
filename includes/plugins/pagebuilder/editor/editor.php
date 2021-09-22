<?php if( !empty( $instance['title'] ) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'] ?>

<div class="siteorigin-widget-tinymce textwidget <?php echo $instance['box'] == false ? 'no-box' : 'box' ?> <?php echo is_null($instance['box']) ? 'box' : 'no-box' ?>">
	<?php echo $text ?>
</div>