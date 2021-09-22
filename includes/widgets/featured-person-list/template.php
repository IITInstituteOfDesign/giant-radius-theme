<?php echo $before_widget; ?>
<?php if (isset($instance['title'])): ?>
	<h4 class="custom-title"><?php echo $instance['title']; ?></h4>
<?php endif; ?>
<?php if (isset($instance['desc'])): ?>
	<p><?php echo $instance['desc']; ?></p>
<?php endif; ?>

<?php if (isset($instance['post'])): ?>

	<?php 
	if (is_array($instance['post'])) {
		$args = array(
			'post_type' => array( 'person' ),
			'post__in' => $instance['post']
		);
	}else{
		$args = array(
			'post_type' => array( 'person' ),
			'p' => $instance['post']
		);
	}



	$loop = new WP_Query( $args );?>
	<?php if ( $loop -> have_posts() ) : while ( $loop -> have_posts() ) : $loop -> the_post(); ?>

		<article class="item">	
			<a href="<?php the_permalink(); ?>"><figure>
				<div class="img-container" style="<?php echo has_post_thumbnail() ? 'background-image:url('.get_the_post_thumbnail_url().')' : 'background-image:url('.get_template_directory_uri().'/assets/img/no-image.svg'.')' ?>"></div>
			</figure></a>
			<div class="main-content">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php if (is_object_in_term(get_the_ID(), 'person_role', array('staff','faculty'))): ?>
					<?php while (has_sub_field('employment')): ?>
						<p class="role">
							<?php echo idiit_person_title(); ?>
						</p>
					<?php endwhile; ?>
				<?php elseif (is_object_in_term(get_the_ID(), 'person_role', array('students','alumni'))): ?>
					<?php while (has_sub_field('degrees')): ?>
						<p class="role">
							<?php $output = array( get_sub_field('program') ); ?>
							<?php $output[] = get_sub_field('year'); ?>
							<?php echo implode(', ', array_filter($output)); ?>
						</p>
					<?php endwhile; ?>
				<?php else: ?>
					<?php while (has_sub_field('employment')): ?>
						<p class="role">
							<?php $output = array( get_sub_field('organization') ); ?>
							<?php $output[] = get_sub_field('position'); ?>
							<?php echo implode(', ', array_filter($output)); ?>
						</p>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</article>

	<?php endwhile; endif; wp_reset_postdata(); ?>
<?php endif; ?>

<?php echo $after_widget; ?>