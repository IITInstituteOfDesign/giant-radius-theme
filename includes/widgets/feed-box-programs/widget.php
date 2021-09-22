<?php

if ( !class_exists('Feed_Box_Programs') ):

  class Feed_Box_Programs extends WP_Widget {
    public $template = 'includes/widgets/feed-box-programs/template.php';

    function Feed_Box_Programs() {
      $widget_ops = array(
        'classname' => 'widget_feed_box',
        'description' => __( "A programs list for homepage use", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Homepage Programs', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      if ($instance['post']) {
        $query = new WP_Query( array( 'post__in' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'page' ) );
        include(locate_template( $this->template ));
        wp_reset_postdata();
      }
    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['btn_text'] = strip_tags($new_instance['btn_text']);
      $instance['post'] = $new_instance['post'];
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'       => '',
        'btn_text'    => '',
        'show_btn'    => false,
        'post'        => null,
      ));

      $title = esc_attr( $instance['title'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      $btn_text = esc_attr( $instance['btn_text'] );
      $post = $instance['post'];
      ?>
      <section id="widget_feed_box_adm_<?php echo $this->number ?>">
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Box Title', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Select programs pages to display:', 'wp_widget_plugin'); ?></label>
          <?php printf('<select class="widefat form-control" id="%s" name="%s" multiple>', $this->get_field_id('post'), $this->get_field_name('post')); ?>
          <?php foreach (get_posts('post_type=page&posts_per_page=-1') as $item): ?>
            <?php if (isset($post) && in_array($item->ID, $post)) {
              $s = 'selected';
            }else{
              $s = '';
            } ?>
            <?php print('<option value="'.$item->ID.'" '.$s.'>'.trim($item->post_title).'</option>') ?>
          <?php endforeach; ?>
        </select>
      </p>
      <div>
        <p>
          <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_btn'); ?>" name="<?php echo $this->get_field_name('show_btn'); ?>" type="checkbox" <?php checked($show_btn); ?>  />
          <label for="<?php echo $this->get_field_id('show_btn'); ?>">Show Button</label>
        </p>
        <p class="tohide">
          <label for="<?php echo $this->get_field_id('btn_text'); ?>"><?php _e('Button Text', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" type="text" value="<?php echo $btn_text; ?>" />
        </p>
      </div>

    </section>


    <script>
      jQuery(document).ready(function($){

        $('#widget_feed_box_adm_<?php echo $this->number ?> select').selectize({
          maxItems: null,
          plugins: ['drag_drop'],
        });
        $('#widget_feed_box_adm_<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
        $('#widget_feed_box_adm_<?php echo $this->number ?> .checkbox-controller').on('change', function(){
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
      });
    </script>



    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Feed_Box_Programs' );
});

endif;
