<?php

if ( !class_exists('Featured_Event') ):

  class Featured_Event extends WP_Widget {
    public $template = 'includes/widgets/featured-event/template.php';

    function Featured_Event() {
      $widget_ops = array(
        'classname' => 'widget_Featured_Event_ctm',
        'description' => __( "A Highlighted Event from Eventbrite", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Highlighted Event', 'idiit-theme'), $widget_ops );
    // add_action( 'admin_footer', array( $this, 'media_fields' ) );
    // add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_img = isset($instance['show_img']) ? $instance['show_img'] : false;
      $custom_title = isset($instance['custom_title']) ? $instance['custom_title'] : false;
      $custom_summary = isset($instance['custom_summary']) ? $instance['custom_summary'] : false;
      $image = ! empty( $instance['image'] ) ? $instance['image'] : '';

    // $query = new WP_Query( array( 'p' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'any' ) );
      if ($instance['post']) {
      include(locate_template( $this->template ));
      }
    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['show_img'] = (bool) $new_instance['show_img'];
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['custom_title'] = (bool) $new_instance['custom_title'];
      $instance['custom_summary'] = (bool) $new_instance['custom_summary'];
      $instance['custom_title_text'] = strip_tags($new_instance['custom_title_text']);
      $instance['custom_summary_text'] = strip_tags($new_instance['custom_summary_text']);
      $instance['image_size'] = strip_tags($new_instance['image_size']);
      $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
      $instance['post'] = $new_instance['post'];
      $instance['btn_text'] = $new_instance['btn_text'];
      $instance['event_time'] = $new_instance['event_time'];
      $instance['event_img'] = $new_instance['event_img'];

      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'custom_title_text'    => '',
        'custom_summary_text'  => '',
        'image_size'           => '',
        'show_img'             => false,
        'show_btn'             => false,
        'custom_title'         => false,
        'custom_summary'       => false,
        'image'                => '',
        'post'                 => null,
        'btn_text'                 => null,
        'btn_link'                 => null,
        'event_img'            => null,
        'event_time'           => null,
        'event_url'            => null,
      ));

      $custom_title_text = esc_attr( $instance['custom_title_text'] );
      $custom_summary_text = esc_attr( $instance['custom_summary_text'] );
      $image_size = esc_attr( $instance['image_size'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      $show_img = esc_attr( $instance['show_img'] );
      $custom_title = esc_attr( $instance['custom_title'] );
      $custom_summary = esc_attr( $instance['custom_summary'] );
      $image = esc_attr( $instance['image'] );
      $post = $instance['post'];
      $btn_text = $instance['btn_text'];
      // $btn_link = $instance['btn_link'];
      $event_img = $instance['event_img'];
      $event_time = $instance['event_time'];
      $event_url = esc_url($instance['event_url']);
      ?>

      <?php if (class_exists('Eventbrite_Query')): ?>
      <section id="widget_Featured_Event_ctm_adm<?php echo $this->number ?>">
        <p>
          <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Select event:', 'wp_widget_plugin'); ?></label>
          <select class="widefat" id="<?php echo $this->get_field_id('post') ?>" name="<?php echo $this->get_field_name('post') ?>">
            <option value="0">Select event</option>
            <?php
            $i = 1;
            $events = new Eventbrite_Query( apply_filters( 'eventbrite_query_args', array(
              'display_private' => false,
              'status' => 'live',
             
            )));
            foreach ($events->posts as $key => $value) {
              if ($value->post_title == $post) {
                $selected = 'selected';
              }else{
                $selected = '';
              }
              echo "<option data-url='".$value->url."' data-time='".$value->post_date."' data-img=".$value->logo->original->url."'' value='".$value->post_title."' ".$selected.">".$value->post_title."</option>";
            }

            ?>
            <?php
            $i++;
            wp_reset_postdata();
            ?>
          </select>
          <input type="hidden" name="<?php echo $this->get_field_name('event_img') ?>" value="<?php echo $event_img ?>" id="<?php echo $this->get_field_id('event_img') ?>">
          <input type="hidden" name="<?php echo $this->get_field_name('event_time') ?>" value="<?php echo $event_time ?>" id="<?php echo $this->get_field_id('event_time') ?>">
          <input type="hidden" name="<?php echo $this->get_field_name('event_url') ?>" value="<?php echo $event_url ?>" id="<?php echo $this->get_field_id('event_url') ?>">
        </p>
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_img'); ?>" name="<?php echo $this->get_field_name('show_img'); ?>" type="checkbox" <?php checked($show_img); ?>  />
            <label for="<?php echo $this->get_field_id('show_img'); ?>">Show Event Image Thumbnail</label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image size:', 'wp_widget_plugin'); ?></label>
            <select class="widefat form-control" id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
              <option value="sm" <?php echo ($image_size == 'sm') ? 'selected' : '' ?>>Small image thumbnail</option>
              <option value="big" <?php echo ($image_size == 'big') ? 'selected' : '' ?>>Big image thumbnail</option>
            </select>
          </p>
        </div>
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('custom_title'); ?>" name="<?php echo $this->get_field_name('custom_title'); ?>" type="checkbox" <?php checked($custom_title); ?>  />
            <label for="<?php echo $this->get_field_id('custom_title'); ?>">Custom Title</label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('custom_title_text'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('custom_title_text'); ?>" name="<?php echo $this->get_field_name('custom_title_text'); ?>" type="text" value="<?php echo $custom_title_text; ?>" />
          </p>
        </div>
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('custom_summary'); ?>" name="<?php echo $this->get_field_name('custom_summary'); ?>" type="checkbox" <?php checked($custom_summary); ?>  />
            <label for="<?php echo $this->get_field_id('custom_summary'); ?>">Custom Summary</label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_name( 'custom_summary_text' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary_text' ); ?>" name="<?php echo $this->get_field_name( 'custom_summary_text' ); ?>" type="text" ><?php echo esc_attr( $custom_summary_text ); ?></textarea>
          </p>
        </div>
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_btn'); ?>" name="<?php echo $this->get_field_name('show_btn'); ?>" type="checkbox" <?php checked($show_btn); ?>  />
            <label for="<?php echo $this->get_field_id('show_btn'); ?>">Show Button</label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_name( 'btn_text' ); ?>"><?php _e( 'Button Text:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn_text' ); ?>" name="<?php echo $this->get_field_name( 'btn_text' ); ?>" value="<?php echo esc_attr( $btn_text ); ?>" type="text" />
          </p>
        </div>
        <script>
          jQuery(document).ready(function($){
            $('#widget_Featured_Event_ctm_adm<?php echo $this->number ?> #<?php echo $this->get_field_id('post') ?>').on('change', function(){
              // alert($(this).val());
              var i = $('option:selected', this).attr('data-img');
              var u = $('option:selected', this).attr('data-url');
              var d = $('option:selected', this).attr('data-time');
              $('input#<?php echo $this->get_field_id('event_img') ?>').val(i);
              $('input#<?php echo $this->get_field_id('event_time') ?>').val(d);
              $('input#<?php echo $this->get_field_id('event_url') ?>').val(u);

            })

            $('#widget_Featured_Event_ctm_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
              if ($(this).is(":checked")) {
                $(this).parent().parent().find('.tohide').show();
              }else{
                $(this).parent().parent().find('.tohide').hide();
              }
            })
            $('#widget_Featured_Event_ctm_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
              if ($(this).is(":checked")) {
                $(this).parent().parent().find('.tohide').show();
              }else{
                $(this).parent().parent().find('.tohide').hide();
              }
            })
          });
        </script>
      </section>
    <?php endif; ?>
      <?php
    }
  }

  add_action( 'widgets_init', function() {
    register_widget( 'Featured_Event' );
  });

endif;
