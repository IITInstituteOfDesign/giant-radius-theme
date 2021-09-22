<?php
$terms = idiit_meta_filter_values( 'degrees', array(
  'repeater' => true,
  'sub_field' => 'program',
  'relationship' => false
));
?>

<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['degree']) ? $filters['degree'] : 0; ?>
<label for="filters-degree">Degrees</label>
<select id="filters-degree" class="form-control" name="filters[degree]">
  <option value="0" <?php selected(empty($value)); ?>>All Degrees</option>

  <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term; ?>" <?php selected($term, $value); ?>>
      <?php echo $term; ?>
    </option>
  <?php endforeach; ?>
</select>
