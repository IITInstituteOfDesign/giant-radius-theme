<?php

if ( !class_exists('Featured_List_Artifact') ):

  class Featured_List_Artifact extends WP_Widget {
    public $template = 'includes/widgets/featured-list-artifact/template.php';

    function Featured_List_Artifact() {
      $widget_ops = array(
        'classname' => 'widget_Featured_List_Artifact_ctm',
        'description' => __( "List of artifacts", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Artifact List', 'idiit-theme'), $widget_ops );
      add_action( 'admin_footer', array( $this, 'media_fields' ) );
      add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
    }

    function widget( $args, $instance ) {
      extract( $args );

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

      $del = 0;
      foreach ($new_instance['custom_title'] as $key => $value) {
        if ($value == '' && $new_instance['custom_summary'][$key] == '' && $new_instance['custom_image'][$key] == '' && $new_instance['custom_url'][$key] == '') {
          unset($new_instance['custom_title'][$key]);
          unset($new_instance['custom_summary'][$key]);
          unset($new_instance['custom_url'][$key]);
          unset($new_instance['custom_image'][$key]);
          $del = 1;
        }
      }
      if ($del == 1) {
        $title = array_values($new_instance['custom_title']); // 'reindex' array
        $summary = array_values($new_instance['custom_summary']); // 'reindex' array
        $image = array_values($new_instance['custom_image']); // 'reindex' array
        $url = array_values($new_instance['custom_url']); // 'reindex' array
        $instance['custom_title'] = $title;
        $instance['custom_summary'] = $summary;
        $instance['custom_image'] = $image;
        $instance['custom_url'] = $url;
      }else{

        $instance['custom_title'] = $new_instance['custom_title'];
        $instance['custom_summary'] = $new_instance['custom_summary'];
        $instance['custom_image'] = $new_instance['custom_image'];
        $instance['custom_url'] = $new_instance['custom_url'];
      }


      // $instance['custom_image'] = ( ! empty( $new_instance['custom_image'] ) ) ? $new_instance['custom_image'] : '';
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'             => '',
        'custom_title'      => array(),
        'custom_summary'    => array(),
        'custom_image'      => array(),
        'custom_url'      => array(),
      ));

      $title = $instance['title'];
      $custom_title = $instance['custom_title'];
      $custom_summary = $instance['custom_summary'];
      $custom_image = $instance['custom_image'];
      $custom_url = $instance['custom_url'];
      ?>

      <section id="widget_Featured_List_Artifact_ctm_adm">
        <div class="items">
          <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>

          <?php foreach ($instance['custom_title'] as $key => $value): ?>
            <div class="item">
              <!-- PERSON NAME -->
              <p>
                <label for="<?php echo $this->get_field_id('custom_title'); ?>[<?php echo $key; ?>]"><?php _e('Artifact Title:', 'wp_widget_plugin'); ?></label>
                <input required class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>[<?php echo $key; ?>]" name="<?php echo $this->get_field_name('custom_title'); ?>[<?php echo $key; ?>]" type="text" value="<?php echo $value; ?>" />
              </p>
              <p>
                <label for="<?php echo $this->get_field_id('custom_url'); ?>[<?php echo $key; ?>]"><?php _e('Artifact URL:', 'wp_widget_plugin'); ?></label>
                <input required class="widefat" id="<?php echo $this->get_field_id('custom_url'); ?>[<?php echo $key; ?>]" name="<?php echo $this->get_field_name('custom_url'); ?>[<?php echo $key; ?>]" type="text" value="<?php echo $instance['custom_url'][$key]; ?>" />
              </p>
              <!-- PERSON SUMMARY -->
              <p>
                <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>[<?php echo $key; ?>]"><?php _e( 'Artifact Summary:' ); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary' ); ?>[<?php echo $key; ?>]" name="<?php echo $this->get_field_name( 'custom_summary' ); ?>[<?php echo $key; ?>]" type="text" ><?php echo $instance['custom_summary'][$key]; ?></textarea>
              </p>
              <!-- PERSON IMAGE -->
              <p class="mediap">
                <label for="<?php echo $this->get_field_id( 'custom_image' ) ?><?php echo $key; ?>">File or Image: </label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'custom_image' ) ?><?php echo $key; ?>" name="<?php echo $this->get_field_name( 'custom_image' ) ?>[<?php echo $key; ?>]" value="<?php echo $instance['custom_image'][$key]; ?>">
                <button id="<?php echo $this->get_field_id( 'custom_image' ) ?><?php echo $key; ?>" class="button select-media custommedia">Add Media</button>
              </p>
              <a href="#" class="button-remove button-primary">Remove Item</a>
            </div>
          <?php endforeach; ?>



        </div>
        <a href="#" id="additem" class="button-primary">Add item</a>
      </section>
      <style>
      #widget_Featured_List_Artifact_ctm_adm .item{
        /*border-bottom: 1px solid #d2d2d2;*/
        /*margin-bottom: 35px;*/
        /*padding-bottom: 25px;*/

        padding: 25px;
        border: 1px solid #d8d8d8;
        border-radius: 0;
        margin-bottom: 25px;
        background-color: #f7f7f7;
      }
      #widget_Featured_List_Artifact_ctm_adm .item p:first-child{
        margin-top: 0;
      }
      #widget_Featured_List_Artifact_ctm_adm .mediap{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      #widget_Featured_List_Artifact_ctm_adm .mediap label{
        width: 100%;
      }
      #widget_Featured_List_Artifact_ctm_adm .mediap input{
        width: calc(100% - 90px);
      }
    </style>
    <script>
      jQuery(document).ready(function($){
        $('#widget_Featured_List_Artifact_ctm_adm .checkbox-controller').each(function( index, element ){
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
        $('#widget_Featured_List_Artifact_ctm_adm .checkbox-controller').on('change', function(){
          console.log('post');
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
        // $('#widget_Featured_List_Artifact_ctm_adm .button-remove').on('click', function(){
          $(document).on("click", "#widget_Featured_List_Artifact_ctm_adm .button-remove", function() {
        // $('#widget_Featured_List_Artifact_ctm_adm .button-remove').on('click', function(){
          $(this).parent().find('input, textarea').val('');
          $(this).parent().hide(500)
        })

          $('#widget_Featured_List_Artifact_ctm_adm #additem').on('click', function(e){
            // e.preventDefault();
            var cant = $('#widget_Featured_List_Artifact_ctm_adm .item').length;
            var cantsum = cant+1;
            console.log(cant);
            $('#widget_Featured_List_Artifact_ctm_adm .items').append(`
              <div class="item">
              <!-- PERSON NAME -->
              <p>
              <label for="<?php echo $this->get_field_id('custom_title'); ?>[`+cantsum+`]"><?php _e('Artifact Title:', 'wp_widget_plugin'); ?></label>
              <input required class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>[`+cantsum+`]" name="<?php echo $this->get_field_name('custom_title'); ?>[`+cantsum+`]" type="text" value="" />
              </p>
              <p>
              <label for="<?php echo $this->get_field_id('custom_url'); ?>[`+cantsum+`]"><?php _e('Artifact URL:', 'wp_widget_plugin'); ?></label>
              <input required class="widefat" id="<?php echo $this->get_field_id('custom_url'); ?>[`+cantsum+`]" name="<?php echo $this->get_field_name('custom_url'); ?>[`+cantsum+`]" type="text" value="" />
              </p>
              <!-- PERSON SUMMARY -->
              <p>
              <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>[`+cantsum+`]"><?php _e( 'Artifact Summary:' ); ?></label>
              <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary' ); ?>[`+cantsum+`]" name="<?php echo $this->get_field_name( 'custom_summary' ); ?>[`+cantsum+`]" type="text" ></textarea>
              </p>
              <!-- PERSON IMAGE -->
              <p class="mediap">
              <label for="<?php echo $this->get_field_id( 'custom_image' ) ?>`+cantsum+`">Image or File: </label> 
              <input class="widefat" id="<?php echo $this->get_field_id( 'custom_image' ) ?>`+cantsum+`" name="<?php echo $this->get_field_name( 'custom_image' ) ?>[`+cantsum+`]" value="">
              <button id="<?php echo $this->get_field_id( 'custom_image' ) ?>`+cantsum+`" class="button select-media custommedia">Add Media</button>
              </p>
              <a href="#" class="button-remove button-primary">Remove Item</a>
              </div>`);
          })




        });
      </script>

      <?php
    }
  }

  add_action( 'widgets_init', function() {
    register_widget( 'Featured_List_Artifact' );
  });

endif;
