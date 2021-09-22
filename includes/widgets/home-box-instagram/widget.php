<?php

if ( !class_exists('Homepage_Instagram') ):

class Homepage_Instagram extends WP_Widget {
  public $template = 'includes/widgets/home-box-instagram/template.php';

  function Homepage_Instagram() {
    $widget_ops = array( 'classname' => 'widget_homepage_instagram', 'description' => __( "A Box with instagram photos", 'idiit-theme' ),  'panels_groups' => array('id-theme'));
    parent::__construct( false, __('ID Homepage Instagram Box', 'idiit-theme'), $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    if (isset($instance['num'])) {
      $num = apply_filters('widget_title', $instance['num']);
    }
    if (isset($instance['cols'])) {
      $cols = apply_filters('widget_title', $instance['cols']);
    }
    $show_follow_btn = isset($instance['show_follow_btn']) ? $instance['show_follow_btn'] : false;
    $show_load_btn = isset($instance['show_load_btn']) ? $instance['show_load_btn'] : false;
    $show_headers = isset($instance['show_headers']) ? $instance['show_headers'] : false;
  
    include(locate_template( $this->template ));
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['num'] = strip_tags($new_instance['num']);
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['cols'] = strip_tags($new_instance['cols']);
    $instance['show_follow_btn'] = (bool) $new_instance['show_follow_btn'];
    $instance['show_load_btn'] = (bool) $new_instance['show_load_btn'];
    $instance['show_header'] = (bool) $new_instance['show_header'];
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'show_follow_btn'       => true,
      'show_load_btn'       => true,
      'show_header'       => true,
      'num'       => '6',
      'title'       => '',
      'cols'       => '5',
    ));

    $show_follow_btn = esc_attr( $instance['show_follow_btn'] );
    $show_load_btn = esc_attr( $instance['show_load_btn'] );
    $show_header = esc_attr( $instance['show_header'] );
    $num = esc_attr( $instance['num'] );
    $title = esc_attr( $instance['title'] );
    $cols = esc_attr( $instance['cols'] );
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Box Title', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number of photos', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="number" value="<?php echo $num; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Columns', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>" type="number" value="<?php echo $cols; ?>" />
    </p>
    <p>
      <input  id="<?php echo $this->get_field_id('show_follow_btn'); ?>" name="<?php echo $this->get_field_name('show_follow_btn'); ?>" type="checkbox" <?php checked($show_follow_btn); ?>  />
      <label for="<?php echo $this->get_field_id('show_follow_btn'); ?>">Show follow us button</label>
    </p>
    <p>
      <input  id="<?php echo $this->get_field_id('show_load_btn'); ?>" name="<?php echo $this->get_field_name('show_load_btn'); ?>" type="checkbox" <?php checked($show_load_btn); ?>  />
      <label for="<?php echo $this->get_field_id('show_load_btn'); ?>">Show load more button</label>
    </p>
    <p>
      <input  id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>" type="checkbox" <?php checked($show_header); ?>  />
      <label for="<?php echo $this->get_field_id('show_header'); ?>">Show header button</label>
    </p>
    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Homepage_Instagram' );
});

endif;
