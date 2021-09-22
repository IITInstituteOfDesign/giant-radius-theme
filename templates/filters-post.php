<section>
	<?php $filters = get_query_var('filters'); ?>

	<h6 class="text-muted">Use the menus below to browse the collection.</h6>
	<?php idiit_filter_form_tag(); ?>
		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/topic'); ?>
		</div>

		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/date'); ?>
		</div>

		<div class="form-group col-md-6">
			<?php get_template_part('templates/filters/search'); ?>
		</div>
	</form>
</section>
