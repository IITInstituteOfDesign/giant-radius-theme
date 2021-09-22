<?php echo $before_widget; ?>
<?php if (isset($instance['height'])) {
	$height = $instance['height'];
}else{
	$height = 350;
} ?>
<?php if (isset($instance['title']) && $instance['title'] != '') {
	echo "<h2 class='aside-title'>".$instance['title']."</h2>";
} ?>
<div class="widget-twitter">
	<a class="twitter-timeline" href="https://twitter.com/IITDesign?ref_src=twsrc%5Etfw" data-height="<?php echo $height ?>">Tweets by IITDesign</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>

<?php echo $after_widget; ?>
