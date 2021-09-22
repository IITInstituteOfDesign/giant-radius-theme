<div class="card" href="<?php the_permalink(); ?>">
  <a href="<?php the_permalink(); ?>"> 
	<?php the_image( true ); ?>

  <strong><?php the_title(); ?></strong><br>
  </a>
<!--	<span style="font-size:8pt">-->

<?php
      $args = array(
        'post_type' => 'attachment',
        'numberposts' => 1,
        'post_status' => null,
        'post_parent' => $post->ID,
        'orderby' => 'title',
        'post_mime_type' => 'application/pdf',
        'offset' => 0,
	'order' => 'ASC'
        ); 


//$attachments = get_posts($args);
//if ($attachments) {
//$i = 0;

//    foreach ($attachments as $attachment) {
//	if($i == 0){
//        	$url = wp_get_attachment_url($attachment->ID);
//        	echo '<a class="linkers" href="' . $url . '"/ alt="resume link">PDF Resume</a>';
//		$i++;
//	}
//    }
//}


//echo "<br />";
echo get_post_meta($post->ID, 'focus', true);
echo "<br />";
//echo get_post_meta($post->ID, 'subfocus', true);
?>

<span>
</div>
