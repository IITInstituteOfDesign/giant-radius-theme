<?php if ( is_tax( get_query_var('taxonomy'), array( 'alumni', 'students' ) ) ): ?>
	<section>
		<h6 class="text-muted">Use the menus below to browse the collection.</h6>
		<?php idiit_filter_form_tag(); ?>
			<?php if ( !empty(get_query_var('filters')) && is_tax( get_query_var('taxonomy'), 'faculty' ) ): ?>
				<div class="form-group col-md-3">
					<?php get_template_part('templates/filters/title'); ?>
				</div>

				<div class="form-group col-md-3">
					<?php get_template_part('templates/filters/designation'); ?>
				</div>

				<div class="form-group col-md-6">
					<?php get_template_part('templates/filters/search'); ?>
				</div>
			<?php elseif ( is_tax( get_query_var('taxonomy'), array('staff', 'faculty') ) ): ?>
				<div class="form-group col-md-3">
					<?php get_template_part('templates/filters/title'); ?>
				</div>

				<div class="form-group col-md-9">
					<?php get_template_part('templates/filters/search'); ?>
				</div>
			<?php elseif ( is_tax( get_query_var('taxonomy'), array( 'alumni', 'students' ) ) ): ?>
				<div class="form-group col-md-3">
					<?php get_template_part('templates/filters/degree'); ?>
				</div>

				<div class="form-group col-md-9">
					<?php get_template_part('templates/filters/search'); ?>
				</div>
			<?php endif; ?>
		</form>
	</section>
<?php endif; ?>
