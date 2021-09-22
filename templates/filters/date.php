<?php $years = idiit_date_filter_values(); ?>
<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['date']) ? $filters['date'] : 0; ?>

<label for="filters-date">Dates</label>
<select id="filters-date" class="form-control" name="filters[date]">
  <option value="0" <?php selected(empty($value)); ?>>All Dates</option>

  <?php foreach ($years as $year): ?>
    <option value="<?php echo $year;?>" <?php selected($year, $value); ?>>
      <?php echo $year; ?>
    </option>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); ?>
</select>
