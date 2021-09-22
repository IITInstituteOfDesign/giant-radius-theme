<?php $course_type = get_query_var('term'); ?>
<?php $course_type = get_term_by('slug', $course_type, 'course_type'); ?>
<div class="course-type">
	<?php if (is_tax('course_type')): ?>
		<h4><?php printf('List of %s courses', $course_type->name); ?></h4>
	<?php else: ?>
		<h2><?php echo $course_type->name; ?></h2>
	<?php endif; ?>

	<?php if (term_description( $course_type->term_id, 'course_type' )): ?>
		<div class="lead">
			<?php echo term_description( $course_type->term_id, 'course_type' ); ?>
		</div>
	<?php endif; ?>
</div>
