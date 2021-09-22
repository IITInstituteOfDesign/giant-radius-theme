<?php

if ( !class_exists('archive_list_tag') ):
  class archive_list_tag extends WP_Widget {
    public $template = 'includes/widgets/tag/template.php';
    function archive_list_tag() {
      $widget_ops = array(
        'classname' => 'widget_archive_list_tag',
        'description' => __( "Displays archive of tag", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Tag Archive', 'idiit-theme'), $widget_ops );
    }
    function widget( $args, $instance ) {
      extract( $args );
      if (isset($instance['tag_filter'])) {
        include(locate_template( $this->template ));
      }
    }
    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['tag_filter'] = $new_instance['tag_filter'];
	  $instance['custom_title'] = strip_tags($new_instance['custom_title']);
      $instance['custom_summary'] = ($new_instance['custom_summary']);

      return $instance;
    }
    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'tag_filter'      => '',
	'custom_title'      => '',
        'custom_summary'    => '',
      ));
      $tag_filter = $instance['tag_filter'];
	  $custom_title = esc_attr( $instance['custom_title'] );
      $custom_summary = esc_attr( $instance['custom_summary'] );
      ?>
      <section id="widget_archive_list_tag<?php echo $this->number ?>">
	  	<p>
      <label for="<?php echo $this->get_field_id('custom_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
		  <input class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>" name="<?php echo $this->get_field_name('custom_title'); ?>" type="text" value="<?php echo $custom_title; ?>" />
		</p>
		<p>
		  <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>"><?php _e( 'Sub Title:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary' ); ?>" name="<?php echo $this->get_field_name( 'custom_summary' ); ?>" style="min-height: 150px"><?php echo $custom_summary; ?></textarea>
		</p>
        <p>
          <?php $post_tags = get_terms( array( 'taxonomy' => 'post_tag', 'hide_empty' => false) ); ?>
          <label for="<?php echo $this->get_field_id('tag_filter'); ?>"><?php _e('Filter Tags By: ', 'wp_widget_plugin'); ?></label>
          <select class="widefat" name="<?php echo $this->get_field_name('tag_filter'); ?>" id="<?php echo $this->get_field_id('tag_filter'); ?>">
            <?php foreach ($post_tags as $key => $value): ?>
              <option value="<?php echo $value->slug; ?>" <?php echo $tag_filter == $value->slug ? 'selected' : '' ?>>
                <?php echo $value->name; ?> (<?php echo $value->count; ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </p>
      </section>

      <?php
    }
  }
  add_action( 'widgets_init', function() {
    register_widget( 'archive_list_tag' );
  });
endif;
