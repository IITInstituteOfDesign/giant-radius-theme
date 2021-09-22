<?php

if ( !class_exists('Featured_ImagePost') ):

  class Featured_ImagePost extends WP_Widget {
    public $template = 'includes/widgets/featured-image-post/template.php';

    function Featured_ImagePost() {
      $widget_ops = array(
        'classname' => 'widget_featured_img_post',
        'description' => __( "A full-width featured image, title and text section", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Featured Image Post', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      $img_filter = isset($instance['img_filter']) ? $instance['img_filter'] : false;
      if ($instance['image']){
        include(locate_template( $this->template ));
        
      }
    }
  /**
  * Media Field Backend
  */
  public function media_fields() {
    ?><script>
      jQuery(document).ready(function($){
        if ( typeof wp.media !== 'undefined' ) {
          var _custom_media = true,
          _orig_send_attachment = wp.media.editor.send.attachment;
          $(document).on('click','.custommedia',function(e) {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            var id = button.attr('id');
            _custom_media = true;
            wp.media.editor.send.attachment = function(props, attachment){
              if ( _custom_media ) {
                $('input#'+id).val(attachment.url);
                $('input#'+id).trigger('change');
              } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
              };
            }
            wp.media.editor.open(button);
            return false;
          });
          $('.add_media').on('click', function(){
            _custom_media = false;
          });
        }
      });
      </script><?php
    }
    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['main_text'] = strip_tags($new_instance['main_text']);
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['img_filter'] = (bool) $new_instance['img_filter'];
      $instance['btn_text'] = strip_tags($new_instance['btn_text']);
      $instance['btn_url'] = strip_tags($new_instance['btn_url']);
      $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'           => '',
        'main_text'       => '',
        'btn_text'        => '',
        'btn_url'         => '',
        'img_filter'      => false,
        'image'           => '',
        'show_btn'        => false,
      ));

      $title = esc_attr( $instance['title'] );
      $main_text = esc_attr( $instance['main_text'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      $img_filter = esc_attr( $instance['img_filter'] );
      $btn_text = esc_attr( $instance['btn_text'] );
      $btn_url = esc_attr( $instance['btn_url'] );
      $image = esc_attr( $instance['image'] );

      ?>
      <section id="widget_featured_img_post_adm<?php echo $this->number ?>">
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Box Title', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_name( 'main_text' ); ?>"><?php _e( 'Summary:' ); ?></label>
          <textarea class="widefat" id="<?php echo $this->get_field_id( 'main_text' ); ?>" name="<?php echo $this->get_field_name( 'main_text' ); ?>" type="text" ><?php echo esc_attr( $main_text ); ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'image' ) ?>">Media Upload</label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'image' ) ?>" name="<?php echo $this->get_field_name( 'image' ) ?>" value="<?php echo esc_attr( $image ); ?>">
          <button id="<?php echo $this->get_field_id( 'image' ) ?>" class="button select-media custommedia">Add Media</button>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id('img_filter'); ?>" name="<?php echo $this->get_field_name('img_filter'); ?>" type="checkbox" <?php checked($img_filter); ?>  />
          <label for="<?php echo $this->get_field_id('img_filter'); ?>">Apply grey filter to image</label>
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

            $('#widget_featured_img_post_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
              if ($(this).is(":checked")) {
                $(this).parent().parent().find('.tohide').show();
              }else{
                $(this).parent().parent().find('.tohide').hide();
              }
            })
            $('#widget_featured_img_post_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
              if ($(this).is(":checked")) {
                $(this).parent().parent().find('.tohide').show();
              }else{
                $(this).parent().parent().find('.tohide').hide();
              }
            })
          });
        </script>

      </section>

      <?php
    }
  }

  add_action( 'widgets_init', function() {
    register_widget( 'Featured_ImagePost' );
  });

endif;
