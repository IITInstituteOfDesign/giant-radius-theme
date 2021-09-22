<a class="course clearfix course-all 
	<?php
	$coursecats_list = wp_get_post_terms( $post->ID, 'course_type' );
	foreach($coursecats_list as $coursecat_list):
		echo 'course-'.$coursecat_list->term_id.' '; 
	endforeach;
	?>" href="<?php the_permalink(); ?>">
	<div class="row">
		<div class="col-md-4">

			<h3><?php the_title(); ?></h3>
			<strong><?php the_field('credit_hours'); ?> credit hours</strong>
		</div>
		<div class="col-md-8 main-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</a>
