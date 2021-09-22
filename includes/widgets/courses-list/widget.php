<?php

if ( !class_exists('courses_list') ):
  class courses_list extends WP_Widget {
    public $template = 'includes/widgets/courses-list/template.php';
    function courses_list() {
      $widget_ops = array(
        'classname' => 'widget_courses_list',
        'description' => __( "A list of courses", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Courses List', 'idiit-theme'), $widget_ops );
    }
    function widget( $args, $instance ) {
      extract( $args );
      include(locate_template( $this->template ));
    }
    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      return $instance;
    }
    function form( $instance ) {
      ?>
      <p>This widget shows a list of courses</p>
      <?php
    }
  }
  add_action( 'widgets_init', function() {
    register_widget( 'courses_list' );
  });
endif;
