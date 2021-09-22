<?php

if ( !class_exists('Feed_Box_Events') ):

  class Feed_Box_Events extends WP_Widget {
    public $template = 'includes/widgets/feed-box-events/template.php';

    function Feed_Box_Events() {
      $widget_ops = array(
        'classname' => 'widget_feed_events',
        'description' => __( "A list of events for homepage use", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Homepage Events', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      $first_event = isset($instance['first_event']) ? $instance['first_event'] : false;
      include(locate_template( $this->template ));
    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = strip_tags($new_instance['limit']);
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['btn_text'] = strip_tags($new_instance['btn_text']);
      $instance['btn_url'] = strip_tags($new_instance['btn_url']);
      $instance['first_event'] = (bool) $new_instance['first_event'];
      $instance['post'] = $new_instance['post'];
      $instance['img'] = $new_instance['img'];
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'       => '',
        'limit'       => '',
        'btn_text'    => '',
        'btn_url'     => '',
        'first_event' => false,
        'show_btn'    => false,
        'post'        => null,
        'img'        => '',
      ));

      $title = esc_attr( $instance['title'] );
      $limit = esc_attr( $instance['limit'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      $first_event = esc_attr( $instance['first_event'] );
      $btn_text = esc_attr( $instance['btn_text'] );
      $btn_url = esc_attr( $instance['btn_url'] );
      $img = $instance['img'];
      $post = $instance['post'];

      ?>
      <?php if (class_exists('Eventbrite_Query')): ?>
      <section id="widget_feed_events_adm<?php echo $this->number ?>">
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Box Title', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Events to be shown <small>(in addition to the highlights)</small>:', 'wp_widget_plugin'); ?></label>
          <input type="number" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $limit; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Featured events:', 'wp_widget_plugin'); ?></label>
          <?php
          $events = new Eventbrite_Query(apply_filters( 'eventbrite_query_args', array(
                       'display_private' => true, // boolean
                       'status' => 'live',         // string (only available for display_private true)
                     ) ) );
                     if ( $events->have_posts() ) :?>
                     <select class="selectize" multiple id="<?php echo $this->get_field_id('post') ?>" name="<?php echo $this->get_field_name('post') ?>[]"  placeholder="Select events...">
                      <?php while ( $events->have_posts() ) : $events->the_post(); ?>
                       <option value="<?php trim(the_title()); ?>" <?php echo isset($post[0]) && in_array(get_the_title(), $post[0]) ? 'selected' : '' ?>><?php trim(the_title()); ?></option>
                     <?php endwhile; ?>
                   </select>
                 <?php else: ?>
                 <select class="selectize" placeholder="No events founded"></select>
               <?php endif; ?>
             </p>
             <p>
              <input id="<?php echo $this->get_field_id('first_event'); ?>" name="<?php echo $this->get_field_name('first_event'); ?>" type="checkbox" <?php checked($first_event); ?>  />
              <label for="<?php echo $this->get_field_id('first_event'); ?>">Highlight upcoming event</label>
            </p>
            <p>
              <label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Show event image:', 'wp_widget_plugin'); ?></label>
              <select class="widefat" id="<?php echo $this->get_field_id('img') ?>" name="<?php echo $this->get_field_name('img') ?>">
               <option value="1" <?php $img == 1 ? 'selected' : '' ?>>Show in all events</option>
               <option value="2" <?php $img == 2 ? 'selected' : '' ?>>Show in featured events</option>
               <option value="3" <?php $img == 3 ? 'selected' : '' ?>>Don't show</option>
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
            <p class="tohide">
              <label for="<?php echo $this->get_field_id('btn_url'); ?>"><?php _e('Button URL', 'wp_widget_plugin'); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('btn_url'); ?>" name="<?php echo $this->get_field_name('btn_url'); ?>" type="text" value="<?php echo $btn_url; ?>" />
            </p>
          </div>




          <script>
            jQuery(document).ready(function($){
              $('#widget_feed_events_adm<?php echo $this->number ?> .selectize').selectize({
                maxItems: null,
              });
              $('#widget_feed_events_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
                if ($(this).is(":checked")) {
                  $(this).parent().parent().find('.tohide').show();
                }else{
                  $(this).parent().parent().find('.tohide').hide();
                }
              })
              $('#widget_feed_events_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
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
      register_widget( 'Feed_Box_Events' );
    });

  endif;
