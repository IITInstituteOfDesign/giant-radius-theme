<label>
  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  <select style="width:100%;" <?php $this->link(); ?>>
    <?php 
      $templates = get_page_templates();
      foreach ( $templates as $template_name => $template_filename ) {
        printf(
          "<option value='%s' %s>%s</option>",
          $template_filename,
          selected( $this->value(), $template_filename ),
          $template_name
        );
      }
    ?>
  </select>
</label>