<?php $filters = get_query_var('filters'); ?>

<section>
	<h6 class="text-muted">Use the menus below to browse the collection.</h6>
	<?php idiit_filter_form_tag(); ?>
		<div class="form-group col-md-3">
			<label for="filters-theme">Theme</label>
			<select class="form-control" id="filters-theme" disabled>
				<option><?php single_term_title(); ?></option>
			</select>
		</div>

		<div class="form-group col-md-3">
			<label for="filters-media">Media</label>
			<select class="form-control" id="filters-media" disabled>
				<option>Projects</option>
			</select>
		</div>

		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/person'); ?>
		</div>

		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/date'); ?>
		</div>
	</form>
</section>
