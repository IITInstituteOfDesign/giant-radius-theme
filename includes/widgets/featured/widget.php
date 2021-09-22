<?php

if ( !class_exists('FeaturedPost') ):

class FeaturedPost extends WP_Widget {
  public $template = 'includes/widgets/featured/template.php';

  function FeaturedPost() {
    $widget_ops = array( 'classname' => 'widget_featured', 'description' => __( "Display a hand-picked post.", 'idiit-theme' ));
    parent::__construct( false, __('Featured Post', 'idiit-theme'), $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $description = $instance['description'];
    $alternate = isset($instance['alternate']) ? $instance['alternate'] : false;
    $anchor = isset($instance['anchor']) ? "id='{$instance['anchor']}'" : '';
    $query = new WP_Query( array( 'p' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'any' ) );
    include(locate_template( $this->template ));
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = empty($new_instance['title']) ? strip_tags(get_post($new_instance['post'], 'ARRAY_A')['post_title']) : strip_tags($new_instance['title']);
    $instance['description'] = wp_kses($new_instance['description']);
    $instance['alternate'] = (bool) $new_instance['alternate'];
    $instance['anchor'] = strip_tags($new_instance['anchor']);
    $instance['post'] = intval($new_instance['post']);
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'title'       => '',
      'description' => '',
      'alternate'   => false,
      'anchor'      => null,
      'post'       	=> null
    ));

    $title = esc_attr( $instance['title'] );
    $description = esc_attr( $instance['description'] );
    $alternate = esc_attr( $instance['alternate'] );
    $anchor = esc_attr( $instance['anchor'] );
    $post = (int) $instance['post'];
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'wp_widget_plugin'); ?></label>
      <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
    </p>

    <p>
      <input  id="<?php echo $this->get_field_id('alternate'); ?>" name="<?php echo $this->get_field_name('alternate'); ?>" type="checkbox" <?php checked($alternate); ?>  />
      <label for="<?php echo $this->get_field_id('alternate'); ?>">Description Below</label>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('anchor'); ?>"><?php _e('Anchor', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('anchor'); ?>" name="<?php echo $this->get_field_name('anchor'); ?>" type="text" value="<?php echo $anchor; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Post', 'wp_widget_plugin'); ?></label>
      <?php printf('<select class="widefat form-control" id="%s" name="%s" multiple>', $this->get_field_id('post'), $this->get_field_name('post')); ?>
        <?php foreach (get_posts('post_type=any&posts_per_page=-1') as $item): ?>
          <?php printf('<option value="%s" %s>%s</option>', $item->ID, selected( $item->ID, $post), trim($item->post_title)); ?>
        <?php endforeach; ?>
      </select>
    </p>

    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'FeaturedPost' );
});

endif;
