<?php

if ( !class_exists('archive_list_people') ):
  class archive_list_people extends WP_Widget {
    public $template = 'includes/widgets/archive/template.php';
    function archive_list_people() {
      $widget_ops = array(
        'classname' => 'widget_archive_list_people',
        'description' => __( "Displays archive of people", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID People Archive', 'idiit-theme'), $widget_ops );
    }
    function widget( $args, $instance ) {
      extract( $args );
      if (isset($instance['archive_filter'])) {
        include(locate_template( $this->template ));
      }
    }
    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['archive_filter'] = $new_instance['archive_filter'];

      return $instance;
    }
    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'archive_filter'      => '',
      ));
      $archive_filter = $instance['archive_filter'];
      ?>
      <section id="widget_archive_list_people<?php echo $this->number ?>">
        <p>
          <?php $person_roles = get_terms( 'person_role'); ?>
          <label for="<?php echo $this->get_field_id('archive_filter'); ?>"><?php _e('Filter Persons By: ', 'wp_widget_plugin'); ?></label>
          <select class="widefat" name="<?php echo $this->get_field_name('archive_filter'); ?>" id="<?php echo $this->get_field_id('archive_filter'); ?>">
            <?php foreach ($person_roles as $key => $value): ?>
              <option value="<?php echo $value->slug; ?>" <?php echo $archive_filter == $value->slug ? 'selected' : '' ?>>
                <?php echo $value->name; ?>
              </option>
            <?php endforeach; ?>
            <option value="profile" <?php echo $archive_filter == 'profile' ? 'selected' : '' ?>>Profiles</option>
          </select>
        </p>
      </section>

      <?php
    }
  }
  add_action( 'widgets_init', function() {
    register_widget( 'archive_list_people' );
  });
endif;
