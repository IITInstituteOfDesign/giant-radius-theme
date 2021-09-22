<?php echo $before_widget; ?>
<?php
$custom_title = esc_attr( $instance['custom_title'] );
$custom_summary = ( $instance['custom_summary'] );
$btn_text = esc_attr( $instance['btn_text'] );
$btn_url = esc_attr( $instance['btn_url'] );
$show_btn = esc_attr( $instance['show_btn'] );
?>
	<h2 class="aside-title"><?php echo $custom_title ?></h2>
	<p><?php echo $custom_summary ?></p>
	<?php if ($show_btn == true): ?>
		<a href="<?php echo $btn_url ?>" class="custom-btn"><?php echo $btn_text; ?></a>
	<?php endif; ?>
<?php echo $after_widget; ?>
