<?php $taxonomy = get_taxonomy('artifact_type'); ?>
<?php $terms = idiit_tax_filter_values( 'artifact_type' ); ?>
<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['artifact_type']) ? $filters['artifact_type'] : 0; ?>
<label for="filters-artifact_type"><?php echo $taxonomy->labels->name; ?></label>
<select id="filters-artifact_type" class="form-control" name="filters[artifact_type]">
  <option value="0" <?php selected(empty($value)); ?>>
    <?php echo $taxonomy->labels->all_items; ?>
  </option>

  <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term->slug; ?>" <?php selected($term->slug, $value); ?>>
      <?php echo $term->name; ?>
    </option>
  <?php endforeach; ?>
</select>
