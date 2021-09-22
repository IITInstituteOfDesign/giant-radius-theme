<?php echo $before_widget; ?>

<?php if ($showbtn == true) {
	$showbtn = true;
}else{
	$showbtn = false;
} ?>


<div class="widget_instagram_content <?php if($showbtn == true){ echo 'show-btn'; }  ?>">
<?php echo do_shortcode('[instagram-feed num='.$images.' showheader=false showbutton=false showfollow=true cols=3]'); ?>
</div>

<?php echo $after_widget; ?>
