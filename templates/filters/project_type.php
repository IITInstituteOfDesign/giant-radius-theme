<?php $taxonomy = get_taxonomy('project_type'); ?>
<?php $terms = idiit_tax_filter_values( 'project_type' ); ?>
<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['project_type']) ? $filters['project_type'] : 0; ?>
<label for="filters-project_type"><?php echo $taxonomy->labels->name; ?></label>
<select id="filters-project_type" class="form-control" name="filters[project_type]">
  <option value="0" <?php selected(empty($value)); ?>>
    <?php echo $taxonomy->labels->all_items; ?>
  </option>

  <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term->slug; ?>" <?php selected($term->slug, $value); ?>>
      <?php echo $term->name; ?>
    </option>
  <?php endforeach; ?>
</select>
