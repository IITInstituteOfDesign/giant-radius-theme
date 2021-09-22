<?php echo $before_widget; ?>
<div class="box">
	<?php
		$args = array(
			'p'  => $instance['post'],
			'ignore_sticky_posts' => true,
			'post_type' => 'any' 
		);
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
	?>

	<article class="content">	
		<?php if ($instance['show_img'] == true): ?>
		<figure>
			<?php if ($instance['custom_image'] == true): ?>
				<img src="<?php echo $instance['image'] ?>" alt="">
			<?php else: ?>
				<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail') ?>" alt="">
			<?php endif; ?>
		</figure>
		<?php endif; ?>
		<div class="main-content">
			<?php if ($instance['custom_title'] == true): ?>
			<h3><a href="<?php the_permalink(); ?>"><?php echo $instance['custom_title_text'] ?></a></h3>
			<?php else: ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php endif; ?>
			<?php if ($instance['custom_summary'] == true): ?>
			<p><?php echo $instance['custom_summary_text'] ?></p>
			<?php else: ?>
			<div><?php the_excerpt(); ?></div>
			<?php endif; ?>
		</div>
	</article>

	<?php   
		endwhile;
		wp_reset_postdata();
	?>
</div>

<?php echo $after_widget; ?>
