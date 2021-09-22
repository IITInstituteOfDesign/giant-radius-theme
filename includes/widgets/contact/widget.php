<?php

if ( !class_exists('Contacts') ):

class Contacts extends WP_Widget {
  public $template = 'includes/widgets/contact/template.php';

  function Contacts() {
    $widget_ops = array( 'classname' => 'widget_contact', 'description' => __( "Lists contact cards relevant to a the current page.", 'idiit-theme' ));
    parent::__construct( false, __('Contact Widget', 'idiit-theme'), $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    if (isset($instance['title'])) {
      $title = apply_filters('widget_title', $instance['title']);
    }

    if (isset($instance['description'])) {
      $description = apply_filters('widget_title', $instance['description']);
    }

    $query_args = array(
      'post_type' => 'person',
      'post__in' => null,
      'ignore_sticky_posts' => true,
      'tax_query' => null,
      'meta_key'  => 'last_name',
      'orderby'   => 'meta_value',
      'order'     => 'ASC',
    );

    if (isset($instance['people'])) {
      $query_args['post__in'] = $instance['people'];
    }

    if (isset($instance['query_args'])) {
      $query_args = shortcode_atts( $query_args, $instance['query_args'] );
    }

    $query = new WP_Query( $query_args );
    include(locate_template( $this->template ));
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['description'] = strip_tags($new_instance['description']);
    $instance['people'] = esc_sql($new_instance['people']);
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'title'       => 'Contacts',
      'description' => '',
      'people'       => array()
    ));

    $title = esc_attr( $instance['title'] );
    $description = esc_attr( $instance['description'] );
    $people = is_array($instance['people']) ? $instance['people'] : array();
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
      <label for="<?php echo $this->get_field_id('people'); ?>"><?php _e('People', 'wp_widget_plugin'); ?></label>
      <?php printf('<select class="widefat form-control" id="%s" name="%s[]" multiple>', $this->get_field_id('people'), $this->get_field_name('people')); ?>
        <?php foreach (get_posts('post_type=person&posts_per_page=-1') as $person): ?>
          <?php printf('<option value="%s" %s>%s</option>', $person->ID, in_array( $person->ID, $people) ? 'selected="selected"' : '', $person->post_title); ?>
        <?php endforeach; ?>
      </select>
    </p>

    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Contacts' );
});

endif;
