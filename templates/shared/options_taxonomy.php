<?php if ($this->name !== 'person_role'): ?>
  <tr class="form-field">
    <th scope="row">
      <label for="featured">Featured Posts</label>
    </th>

    <td>
      <?php $option = 'term_meta[featured]'; ?>
      <?php $value = isset($term_meta['featured']) ? $term_meta['featured'] : array(); ?>
      <?php $posts = $this->get_posts( $term ); ?>
      <select id="featured" class="form-control" name="<?php echo $option; ?>[]" multiple data-items="<?php echo implode(',', get_option($option)); ?>">
        <?php foreach ($posts as $post): ?>
          <option value="<?php echo $post->ID; ?>" <?php selected( in_array($post->ID, (array) $value) ); ?>>
            <?php echo $post->post_title; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </td>
  </tr>
<?php endif; ?>

<tr class="form-field">
  <?php $option = 'term_meta[sidebar]'; ?>
  <?php $value = isset($term_meta['sidebar']) ? $term_meta['sidebar'] :''; ?>
  <th scope="row">
    <label for="sidebar">Sidebar</label>
  </th>

  <td>
    <?php wp_editor( $value, 'sidebar', array( 'textarea_name' => $option, 'textarea_rows' => get_option('default_post_edit_rows', 5) ) ); ?>
    <p class="description">If present, the description will take up 2/3 width and this will take the remaining 1/3.</p>
  </td>
</tr>
