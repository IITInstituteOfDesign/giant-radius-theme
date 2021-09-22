<?php

if ( !class_exists('Twitter') ):

class Twitter extends WP_Widget {
  public $template = 'includes/widgets/twitter/template.php';

  function Twitter() {
    $widget_ops = array( 'classname' => 'widget_twitter', 'description' => __( "ID Twitter Feed", 'idiit-theme' ));
    parent::__construct( false, __('Twitter Widget', 'idiit-theme'), $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    if (isset($instance['title'])) {
      $title = apply_filters('widget_title', $instance['title']);
    }


    include(locate_template( $this->template ));
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['height'] = strip_tags($new_instance['height']);
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'title'       => 'Twitter',
      'height'       => '',
    ));

    $title = esc_attr( $instance['title'] );
    $height = esc_attr( $instance['height'] );
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Box Height (optional)', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
    </p>


    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Twitter' );
});

endif;
