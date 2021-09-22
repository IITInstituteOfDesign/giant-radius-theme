<?php

if ( !class_exists('Slider') ):

  class Slider extends WP_Widget {
    public $template = 'includes/widgets/slider/template.php';

    function Slider() {
      $widget_ops = array(
        'classname' => 'widget_Slider_ctm',
        'description' => __( "Slider of images", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Image Slider', 'idiit-theme'), $widget_ops );
      add_action( 'admin_footer', array( $this, 'media_fields' ) );
      add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
    }

    function widget( $args, $instance ) {
      extract( $args );

      if ($instance['custom_image']) {
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

      $del = 0;
      foreach ($new_instance['custom_image'] as $key => $value) {
        if ($value == '') {
          unset($new_instance['custom_image'][$key]);
          $del = 1;
        }
      }
      if ($del == 1) {
        $image = array_values($new_instance['custom_image']); // 'reindex' array
        $instance['custom_image'] = $image;
      }else{

        $instance['custom_image'] = $new_instance['custom_image'];
      }


      // $instance['custom_image'] = ( ! empty( $new_instance['custom_image'] ) ) ? $new_instance['custom_image'] : '';
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'             => '',
        'custom_image'      => array(),
      ));

      $title = $instance['title'];
      $custom_image = $instance['custom_image'];
      ?>

      <section id="widget_Slider_ctm_adm<?php echo $this->number ?>">
        <div class="items">
          <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>

          <?php //if (count($instance['custom_title']) > 1): ?>
          <?php foreach ($instance['custom_image'] as $key => $value): ?>
            <div class="item">
              <!-- PERSON IMAGE -->
              <p class="mediap">
                <label for="<?php echo $this->get_field_id( 'custom_image' ) ?><?php echo $key; ?>">Image: </label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'custom_image' ) ?><?php echo $key; ?>" name="<?php echo $this->get_field_name( 'custom_image' ) ?>[<?php echo $key; ?>]" value="<?php echo $instance['custom_image'][$key]; ?>">
                <button id="<?php echo $this->get_field_id( 'custom_image' ) ?><?php echo $key; ?>" class="button select-media custommedia">Add Media</button>
              </p>
              <a href="#" class="button-remove button-primary">Remove Item</a>
            </div>
          <?php endforeach; ?>
          <?php //endif; ?>



        </div>
        <a href="#" id="additem" class="button-primary">Add item</a>
      </section>
      <style>
      #widget_Slider_ctm_adm .item{
        /*border-bottom: 1px solid #d2d2d2;*/
        /*margin-bottom: 35px;*/
        /*padding-bottom: 25px;*/

        padding: 25px;
        border: 1px solid #d8d8d8;
        border-radius: 0;
        margin-bottom: 25px;
        background-color: #f7f7f7;
      }
      #widget_Slider_ctm_adm .item p:first-child{
        margin-top: 0;
      }
      #widget_Slider_ctm_adm .mediap{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      #widget_Slider_ctm_adm .mediap label{
        width: 100%;
      }
      #widget_Slider_ctm_adm .mediap input{
        width: calc(100% - 90px);
      }
    </style>
    <script>
      jQuery(document).ready(function($){
        $('#widget_Slider_ctm_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
        $('#widget_Slider_ctm_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
          console.log('post');
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
        // $('#widget_Slider_ctm_adm .button-remove').on('click', function(){
          $(document).on("click", "#widget_Slider_ctm_adm<?php echo $this->number ?> .button-remove", function() {
        // $('#widget_Slider_ctm_adm .button-remove').on('click', function(){
          $(this).parent().find('input, textarea').val('');
          $(this).parent().hide(500)
        })

          $('#widget_Slider_ctm_adm<?php echo $this->number ?> #additem').on('click', function(e){			
            // e.preventDefault();
            var cant = $('#widget_Slider_ctm_adm<?php echo $this->number ?> .item').length;
            var cantsum = cant+1;
            console.log(cant);
			
            $('#widget_Slider_ctm_adm<?php echo $this->number ?> .items').append('<div class="item"><!-- PERSON IMAGE --><p class="mediap"><label for="<?php echo $this->get_field_id( 'custom_image' ) ?>'+cantsum+'">Image: </label> <input class="widefat" id="<?php echo $this->get_field_id( 'custom_image' ) ?>'+cantsum+'" name="<?php echo $this->get_field_name( 'custom_image' ) ?>['+cantsum+']" value=""><button id="<?php echo $this->get_field_id( 'custom_image' ) ?>'+cantsum+'" class="button select-media custommedia">Add Media</button></p><a href="#" class="button-remove button-primary">Remove Item</a></div>');
          })




        });
      </script>

      <?php
    }
  }

  add_action( 'widgets_init', function() {
    register_widget( 'Slider' );
  });

endif;
