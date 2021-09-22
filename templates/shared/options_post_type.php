<div class="wrap">
  <h2><?php echo $this->plural; ?> Options</h2>

  <form method="post" action="" novalidate="novalidate">
    <?php wp_nonce_field( $this->options_base ) ?>

    <table class="form-table">
      <tbody>
        <tr>
          <?php $option = sprintf('%s_featured', $this->options_base); ?>
          <th scope="row">
            <label for="<?php echo $option; ?>"><?php printf('Featured %s', $this->plural); ?></label>
          </th>

          <td>
            <?php $posts = get_posts("post_type=$this->name&posts_per_page=-1"); ?>
            <select id="<?php echo $option; ?>" class="form-control" name="<?php echo $option; ?>[]" multiple data-items="<?php echo implode(',', get_option($option)); ?>">
              <?php foreach ($posts as $post): ?>
                <option value="<?php echo $post->ID; ?>" <?php selected( in_array($post->ID, (array) get_option($option)) ); ?>>
                  <?php echo $post->post_title; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>

        <tr>
          <?php $option = sprintf('%s_description', $this->options_base); ?>
          <th scope="row">
            <label for="<?php echo $option; ?>">Description</label>
          </th>

          <td>
            <?php wp_editor( get_option($option), $option ); ?>
          </td>
        </tr>

        <tr>
          <?php $option = sprintf('%s_sidebar', $this->options_base); ?>
          <th scope="row">
            <label for="<?php echo $option; ?>">Sidebar</label>
          </th>

          <td>
            <?php wp_editor( get_option($option), $option, array( 'textarea_rows' => get_option('default_post_edit_rows', 5) ) ); ?>
            <p class="description">If present, the description will take up 2/3 width and this will take the remaining 1/3.</p>
          </td>
        </tr>
      </tbody>
    </table>

    <?php submit_button(); ?>
  </form>
</div>
