<?php $post_type = get_post_type_object('person'); ?>
<?php $terms = idiit_meta_filter_values( 'person' ); ?>
<?php $filters = get_query_var('filters'); ?>
<?php $value = isset($filters['person']) ? $filters['person'] : 0; ?>
<label for="filters-person"><?php echo $post_type->labels->name; ?></label>
<select id="filters-person" class="form-control" name="filters[person]">
  <option value="0" <?php selected(empty($value)); ?>>
    <?php echo $post_type->labels->all_items; ?>
  </option>

  <?php foreach ($terms as $term): ?>
    <?php $post = get_post( $term ); ?>
    <?php if (!empty($post)): ?>
      <?php setup_postdata($post); ?>
      <option value="<?php the_ID();?>" <?php selected(get_the_ID(), $value); ?>>
        <?php the_title(); ?>
      </option>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); ?>
</select>
