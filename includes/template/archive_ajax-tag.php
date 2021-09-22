<?php 
$post_type_obj = get_post_type_object(get_post_type());
$post_type_name = $post_type_obj->labels->singular_name;
?>
<div class="col-xl-3 col-lg-4 col-sm-6">
	<a href="<?php the_permalink(); ?>" class="archive_item">
		<span class="archive_item__type">
			<?php echo ($post_type_name == 'Post') ? 'News' : $post_type_name; ?>
		</span>
		<figure><img src="<?php echo (has_post_thumbnail() == true) ? get_the_post_thumbnail_url(get_the_ID(),'card') : get_template_directory_uri().'/assets/img/no-image.svg' ?>" alt=""></figure>
		<h3><?php the_title(); ?></h3>
	</a>
</div>