<?php

if ( !class_exists('Feed_Box') ):

  class Feed_Box extends WP_Widget {
    public $template = 'includes/widgets/feed-box/template.php';

    function Feed_Box() {
      $widget_ops = array(
        'classname' => 'widget_feed_box',
        'description' => __( "A list of posts for homepage user", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Homepage Post List', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      $post_type = esc_attr( $instance['post_type'] );
      $limit = esc_attr( $instance['limit'] );
      if($limit) {
        $limit = $limit;
      }else{
        $limit = 4;
      }
      $query_args = array(
        'post_type' => $post_type,
        'posts_per_page' => $limit,
        'no_found_rows' => true,
      );
      $query = new WP_Query( $query_args );
      include(locate_template( $this->template ));
    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['post_type'] = strip_tags($new_instance['post_type']);
      $instance['btn_text'] = strip_tags($new_instance['btn_text']);
      $instance['limit'] = strip_tags($new_instance['limit']);
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'          => 'Last News',
        'btn_text'       => 'All News',
        'post_type'      => null,
        'limit'          => 6,
        'show_btn'       => false,
      ));

      $title = esc_attr( $instance['title'] );
      $post_type = esc_attr( $instance['post_type'] );
      $btn_text = esc_attr( $instance['btn_text'] );
      $limit = esc_attr( $instance['limit'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      ?>

      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Box Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
        <input  id="<?php echo $this->get_field_id('show_btn'); ?>" name="<?php echo $this->get_field_name('show_btn'); ?>" type="checkbox" <?php checked($show_btn); ?>  />
        <label for="<?php echo $this->get_field_id('show_btn'); ?>">Show Button</label>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('btn_text'); ?>"><?php _e('Button Text', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" type="text" value="<?php echo $btn_text; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type', 'wp_widget_plugin'); ?></label>
        <select class="widefat form-control" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
          <?php foreach (get_post_types(array('public' => true), 'objects') as $cpt): ?>
            <option value="<?php echo $cpt->name; ?>"<?php selected($cpt->name, $post_type); ?>>
              <?php echo $cpt->label; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" step="1" max="20" min="1" />
      </p>

      <?php
    }
  }

  add_action( 'widgets_init', function() {
    register_widget( 'Feed_Box' );
  });

endif;
