<?php $terms = idiit_meta_filter_values( 'designation', array( 'relationship' => false ) ); ?>
<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['designation']) ? $filters['designation'] : 0; ?>
<label for="filters-designation">Designations</label>
<select id="filters-designation" class="form-control" name="filters[designation]">
  <option value="0" <?php selected(empty($value)); ?>>All Designations</option>

  <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term; ?>" <?php selected($term, $value); ?>>
      <?php echo ucwords($term); ?>
    </option>
  <?php endforeach; ?>
</select>
