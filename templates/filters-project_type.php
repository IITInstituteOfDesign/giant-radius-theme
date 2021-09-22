<section>
	<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
	<h6 class="text-muted">Use the menus below to browse the collection.</h6>
	<?php idiit_filter_form_tag(); ?>
		<div class="form-group col-md-3">
			<?php get_template_part('templates/filters/topic'); ?>
		</div>

		<div class="form-group col-md-3">
			<label for="filters-type">Project Type</label>
			<select class="form-control" id="filters-type" disabled>
				<option value="<?php echo $term->slug; ?>">
					<?php echo $term->name; ?>
				</option>
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
