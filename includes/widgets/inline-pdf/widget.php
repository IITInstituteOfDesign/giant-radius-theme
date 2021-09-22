<?php

if ( !class_exists('Inline_PDF') ):

  class Inline_PDF extends WP_Widget {
    public $template = 'includes/widgets/inline-pdf/template.php';

    function Inline_PDF() {
      $widget_ops = array(
        'classname' => 'widget_Inline_PDF_ctm',
        'description' => __( "A PDF viewer block", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID PDF Viewer', 'idiit-theme'), $widget_ops );
      add_action( 'admin_footer', array( $this, 'media_fields' ) );
      add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
    }

    function widget( $args, $instance ) {
      extract( $args );

      if ($instance['custom_pdf']) {
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
      $instance['custom_pdf'] = $new_instance['custom_pdf'];
      $instance['custom_height'] = $new_instance['custom_height'];
      return $instance;
    }


      // $instance['custom_pdf'] = ( ! empty( $new_instance['custom_pdf'] ) ) ? $new_instance['custom_pdf'] : '';

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'             => '',
        'custom_pdf'      => '',
        'custom_height'      => '',
      ));

      $title = $instance['title'];
      $custom_height = $instance['custom_height'];
      $custom_pdf = $instance['custom_pdf'];
      ?>

      <section id="Inline_PDF_ctm_adm<?php echo $this->number ?>">
        <div class="items">
          <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>
          <p class="mediap">
            <label for="<?php echo $this->get_field_id( 'custom_pdf' ) ?>">File: </label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'custom_pdf' ) ?>" name="<?php echo $this->get_field_name( 'custom_pdf' ) ?>" value="<?php echo $instance['custom_pdf']; ?>">
            <button id="<?php echo $this->get_field_id( 'custom_pdf' ) ?>" class="button select-media custommedia">Add Media</button>
          </p>
          <p>
            <label for="<?php echo $this->get_field_id('custom_height'); ?>"><?php _e('Custom height <small>in PX</small>', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('custom_height'); ?>" name="<?php echo $this->get_field_name('custom_height'); ?>" type="text" value="<?php echo $custom_height; ?>" />
          </p>
        </div>
      </section>

      <?php
    }
  }


  add_action( 'widgets_init', function() {
    register_widget( 'Inline_PDF' );
  });

endif;
