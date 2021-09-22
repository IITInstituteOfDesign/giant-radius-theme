<?php echo $before_widget; ?>
<?php if (isset($instance['title'])): ?>
	<div class="header">
		<h4 class="custom-title"><?php echo $instance['title']; ?></h4>
		<?php if (isset($instance['custom_pdf'])): ?>
			<a href="<?php echo $instance['custom_pdf'] ?>" target="_blank">View Full Screen</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if (isset($instance['custom_pdf'])): ?>
	<object data='<?php echo $instance['custom_pdf'] ?>' 
		type='application/pdf' 
		width='100%' 
		<?php echo isset($instance['custom_height']) && $instance['custom_height'] != '' ? "height='".$instance['custom_height']."px' style='height: ".$instance['custom_height']."px !important'" : "height='400px' style='height: 400px !important'" ?>
		>
		<p style="margin: 0">This browser does not support inline PDFs. Please download the PDF to view it: <a href="<?php echo $instance['custom_pdf'] ?>">Download PDF</a></p>
	</object>
<?php endif; ?>

<?php echo $after_widget; ?>
