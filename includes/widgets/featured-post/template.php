<?php echo $before_widget; ?>
<?php
$custom_title_text = esc_attr( $instance['custom_title_text'] );
$custom_summary_text = esc_attr( $instance['custom_summary_text'] );
$show_img = esc_attr( $instance['show_img'] );
$custom_title = esc_attr( $instance['custom_title'] );
$custom_summary = esc_attr( $instance['custom_summary'] );
$custom_image = esc_attr( $instance['custom_image'] );
$post = (int) $instance['post'];
$image = esc_attr( $instance['image'] );
?>

<div class="box">
	<?php
		$args = array(
			'p'      => $post,
		);
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
	?>

	<article class="content">	
		<?php if ($show_img == true): ?>
		<figure>
			<?php if ($custom_image == true): ?>
				<img src="<?php echo $image ?>" alt="">
			<?php else: ?>
				<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail') ?>" alt="">
			<?php endif; ?>
		</figure>
		<?php endif; ?>
		<div class="main-content">
			<?php if ($custom_title == true): ?>
			<h3><a href="<?php the_permalink(); ?>"><?php echo $custom_title_text ?></a></h3>
			<?php else: ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php endif; ?>
			<?php if ($custom_summary == true): ?>
			<p><?php echo $custom_summary_text ?></p>
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
