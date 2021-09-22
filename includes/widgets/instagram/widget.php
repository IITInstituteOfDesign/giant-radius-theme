<?php

if ( !class_exists('Instagram') ):

class Instagram extends WP_Widget {
  public $template = 'includes/widgets/instagram/template.php';

  function Instagram() {
    $widget_ops = array( 'classname' => 'widget_instagram', 'description' => __( "Instagram Widget", 'idiit-theme' ),  'panels_groups' => array('id-theme'));
    parent::__construct( false, __('Instagram Widget', 'idiit-theme'), $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    if (isset($instance['images'])) {
      $images = apply_filters('widget_title', $instance['images']);
    }
    $showbtn = isset($instance['showbtn']) ? $instance['showbtn'] : false;
  
    include(locate_template( $this->template ));
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['images'] = strip_tags($new_instance['images']);
    $instance['showbtn'] = (bool) $new_instance['showbtn'];
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'showbtn'       => true,
      'images'       => '6',
    ));

    $showbtn = esc_attr( $instance['showbtn'] );
    $images = esc_attr( $instance['images'] );
    ?>
    <p>
      <input  id="<?php echo $this->get_field_id('showbtn'); ?>" name="<?php echo $this->get_field_name('showbtn'); ?>" type="checkbox" <?php checked($showbtn); ?>  />
      <label for="<?php echo $this->get_field_id('showbtn'); ?>">Show follow us button</label>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('images'); ?>"><?php _e('Images to show', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" type="number" value="<?php echo $images; ?>" />
    </p>

    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Instagram' );
});

endif;
