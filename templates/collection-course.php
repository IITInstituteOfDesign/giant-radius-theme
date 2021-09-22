<div id="courses">
	<?php $args = array( 'parent' => 0, 'orderby' => 'slug' ); ?>
	<?php $course_types = get_terms( array( 'course_type' ), $args ); ?>
	<?php foreach ($course_types as $course_type): ?>
		<div class="course-tp">
			<?php set_query_var('term', $course_type->slug); ?>
			<?php get_template_part('templates/page-content', 'course_type'); ?>
			<?php get_template_part('templates/collection', 'course_type'); ?>
		</div>
	<?php endforeach; ?>
</div>
