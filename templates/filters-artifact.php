<section>
	<h6 class="text-muted">Use the menus below to browse the collection.</h6>
	<?php idiit_filter_form_tag(); ?>
		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/topic'); ?>
		</div>

		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/artifact_type'); ?>
		</div>

		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/person'); ?>
		</div>

		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/date'); ?>
		</div>
	</form>
</section>
