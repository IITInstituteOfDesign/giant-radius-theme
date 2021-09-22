<?php

if ( !class_exists('Featured_Link') ):

  class Featured_Link extends WP_Widget {
    public $template = 'includes/widgets/featured-link/template.php';

    function Featured_Link() {
      $widget_ops = array(
        'classname' => 'widget_featured_link_ctm',
        'description' => __( "Highlighted Post", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Highlighted Link', 'idiit-theme'), $widget_ops );
      add_action( 'admin_footer', array( $this, 'media_fields' ) );
      add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_img = isset($instance['show_img']) ? $instance['show_img'] : false;
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      $btn_target = isset($instance['btn_target']) ? $instance['btn_target'] : false;
      $image = ! empty( $instance['image'] ) ? $instance['image'] : '';

    // $query = new WP_Query( array( 'p' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'any' ) );
      include(locate_template( $this->template ));
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
      $instance['summary'] = strip_tags($new_instance['summary']);
      $instance['btn_url'] = strip_tags($new_instance['btn_url']);
      $instance['btn_text'] = strip_tags($new_instance['btn_text']);
      $instance['image_size'] = strip_tags($new_instance['image_size']);
      $instance['show_img'] = (bool) $new_instance['show_img'];
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['btn_target'] = (bool) $new_instance['btn_target'];
      $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'      => '',
        'summary'    => '',
        'btn_url'                => '',
        'btn_text'               => '',
        'image_size'               => '',
        'show_img'           => false,
        'show_btn'           => false,
        'btn_target'           => false,
        'image'                  => '',
      ));

      $title = esc_attr( $instance['title'] );
      $summary = esc_attr( $instance['summary'] );
      $btn_url = esc_attr( $instance['btn_url'] );
      $btn_text = esc_attr( $instance['btn_text'] );
      $show_img = esc_attr( $instance['show_img'] );
      $image_size = esc_attr( $instance['image_size'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      $btn_target = esc_attr( $instance['btn_target'] );
      $image = esc_attr( $instance['image'] );
      ?>
      <section id="widget_featured_link_ctm_adm<?php echo $this->number ?>">
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name( 'summary' ); ?>"><?php _e( 'Description:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id( 'summary' ); ?>" name="<?php echo $this->get_field_name( 'summary' ); ?>" type="text" ><?php echo esc_attr( $summary ); ?></textarea>
      </p>
    <div>
      <p>
        <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_img'); ?>" name="<?php echo $this->get_field_name('show_img'); ?>" type="checkbox" <?php checked($show_img); ?>  />
        <label for="<?php echo $this->get_field_id('show_img'); ?>">Show image</label>
      </p>
      <p class="tohide">
        <label for="<?php echo $this->get_field_id( 'image' ) ?>">Media Upload</label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'image' ) ?>" name="<?php echo $this->get_field_name( 'image' ) ?>" value="<?php echo esc_attr( $image ); ?>">
        <button id="<?php echo $this->get_field_id( 'image' ) ?>" class="button select-media custommedia">Add Media</button>
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
        <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_btn'); ?>" name="<?php echo $this->get_field_name('show_btn'); ?>" type="checkbox" <?php checked($show_btn); ?>  />
        <label for="<?php echo $this->get_field_id('show_btn'); ?>">Show button</label>
      </p>
    <p class="tohide">
      <label for="<?php echo $this->get_field_id('btn_text'); ?>"><?php _e('Button Text', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('btn_text'); ?>" name="<?php echo $this->get_field_name('btn_text'); ?>" type="text" value="<?php echo $btn_text; ?>" />
    </p>
    <p class="tohide">
      <label for="<?php echo $this->get_field_id('btn_url'); ?>"><?php _e('Button URL', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('btn_url'); ?>" name="<?php echo $this->get_field_name('btn_url'); ?>" type="text" value="<?php echo $btn_url; ?>" />
    </p>
    <p class="tohide">
        <input id="<?php echo $this->get_field_id('btn_target'); ?>" name="<?php echo $this->get_field_name('btn_target'); ?>" type="checkbox" <?php checked($btn_target); ?>  />
        <label for="<?php echo $this->get_field_id('btn_target'); ?>">Open in new tab</label>
      </p>
    </div>
  </section>
  <script>
    jQuery(document).ready(function($){
      $('#widget_featured_link_ctm_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
        if ($(this).is(":checked")) {
          $(this).parent().parent().find('.tohide').show();
        }else{
          $(this).parent().parent().find('.tohide').hide();
        }
      })
      $('#widget_featured_link_ctm_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
        console.log('post');
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
  register_widget( 'Featured_Link' );
});

endif;
