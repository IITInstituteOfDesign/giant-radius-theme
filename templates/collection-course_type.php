<?php $course_type = get_query_var('term'); ?>
<?php $course_type = get_term_by('slug', $course_type, 'course_type'); ?>
<?php get_courses(); ?>

<?php while (have_posts()): the_post(); ?>
	<?php get_template_part('templates/course'); ?>
<?php endwhile; ?>

<?php
$args = array(
	'orderby' => 'slug',
	'parent' => $course_type->term_id
);
?>
<?php $parent_course = $course_type; ?>
<?php $course_types = get_terms( array( 'course_type' ), $args ); ?>
<?php if (!empty($course_types)): ?>
	<?php foreach ($course_types as $course_type): ?>
		<?php set_query_var('term', $course_type->slug); ?>
		<?php get_courses(); ?>

		<?php if (have_posts()): ?>

			<div class="course-divider--content">
				<div class="course-divider">
					<?php echo $course_type->name; ?>
					<div class="pull-right">
						<?php global $wp_query; ?>
						<?php $count = (int) $wp_query->found_posts; ?>
						<?php echo post_type_heading('course', $count); ?>
					</div>
				</div>
				<?php while (have_posts()): the_post(); ?>
					<?php get_template_part('templates/course'); ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>