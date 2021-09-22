<?php
  $terms = idiit_meta_filter_values( 'employment', array(
    'repeater' => true,
    'sub_field' => 'position',
    'relationship' => false
  ));
?>

<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['title']) ? $filters['title'] : 0; ?>
<label for="filters-title">Titles</label>
<select id="filters-title" class="form-control" name="filters[title]">
  <option value="0" <?php selected(empty($value)); ?>>All Titles</option>

  <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term; ?>" <?php selected($term, $value); ?>>
      <?php echo $term; ?>
    </option>
  <?php endforeach; ?>
</select>
