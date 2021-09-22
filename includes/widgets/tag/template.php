<?php echo $before_widget; ?>
<?php
$custom_title = esc_attr( $instance['custom_title'] );
$custom_summary = esc_attr( $instance['custom_summary'] );
?>
<div id="tag_widget" class="container p-0">
	<?php if($custom_title!="") { ?><h2 class="aside-title"><?php echo $custom_title ?></h2><?php } ?>
	<?php if($custom_summary!="") { ?><p><?php echo $custom_summary ?></p><?php } ?>
	<div class="row loadmore archive_main">		
		<?php
		$cnt=0;
		global $wp_query;
		$args = filtered_query( array(
			'posts_per_page' => -1,
			'tag'  => array($instance['tag_filter']),
		));
		$query = new WP_Query( $args );
		custom_my_load_more_scripts($query->query_vars, $query->max_num_pages, $query->current_page, 'card-person-2');
		if ( $query->have_posts() ):
			while ( $query->have_posts() ):
				$query->the_post(); $cnt++;
				
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
				<?php
			endwhile;
			// echo '</div>';
			if ($query->max_num_pages > 1) {
				echo '<div class="row"><div class="col-12 text-center"><div class="custom_loadmore custom-btn">LOAD MORE</div></div></div>';
			}		
		endif;
		wp_reset_postdata();
		if($cnt==0)
			echo '<div class="col-12">No posts assigned to this tag.</div>';
           ?>

	</div>
</div>
<?php echo $after_widget; ?>