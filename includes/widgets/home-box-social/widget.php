<?php

if ( !class_exists('Homepage_Social') ):

class Homepage_Social extends WP_Widget {
  public $template = 'includes/widgets/home-box-social/template.php';

  function Homepage_Social() {
    $widget_ops = array( 'classname' => 'widget_social_media', 'description' => __( "Social media buttons", 'idiit-theme' ));
    parent::__construct( false, __('ID Homepage Social Buttons', 'idiit-theme'), $widget_ops );
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
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'title'       => 'Social Media',
    ));

    $title = esc_attr( $instance['title'] );
    ?>

    <p>This widgets display the media buttons available on <a href="admin.php?page=site-settings" target="_blank">Site Settings Page</a></p>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>


    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Homepage_Social' );
});

endif;
