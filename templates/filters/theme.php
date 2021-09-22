<?php $taxonomy = get_taxonomy('theme'); ?>
<?php $terms = idiit_tax_filter_values( 'theme' ); ?>
<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['theme']) ? $filters['theme'] : 0; ?>
<label for="filters-theme"><?php echo $taxonomy->labels->name; ?></label>
<select id="filters-theme" class="form-control" name="filters[theme]">
  <option value="0" <?php selected(empty($value)); ?>>
    <?php echo $taxonomy->labels->all_items; ?>
  </option>

  <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term->slug; ?>" <?php selected($term->slug, $value); ?>>
      <?php echo $term->name; ?>
    </option>
  <?php endforeach; ?>
</select>
