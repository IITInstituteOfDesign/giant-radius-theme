<?php

if ( !class_exists('Featured_Person') ):

  class Featured_Person extends WP_Widget {
    public $template = 'includes/widgets/featured-person/template.php';

    function Featured_Person() {
      $widget_ops = array(
        'classname' => 'widget_Featured_Person_ctm',
        'description' => __( "Highlighted Person", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Highlighted Person', 'idiit-theme'), $widget_ops );
      add_action( 'admin_footer', array( $this, 'media_fields' ) );
      add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $btn_person = isset($instance['btn_person']) ? $instance['btn_person'] : false;
      $person_image = ! empty( $instance['person_image'] ) ? $instance['person_image'] : '';

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
	  $instance['custom_title'] = strip_tags($new_instance['custom_title']);
      $instance['custom_summary'] = ($new_instance['custom_summary']);
      $instance['person_name'] = strip_tags($new_instance['person_name']);
      $instance['person_role'] = strip_tags($new_instance['person_role']);
      $instance['person_email'] = strip_tags($new_instance['person_email']);
      $instance['person_image'] = ( ! empty( $new_instance['person_image'] ) ) ? $new_instance['person_image'] : '';
      $instance['image_size'] = strip_tags($new_instance['image_size']);
      $instance['btn_person'] = (bool) $new_instance['btn_person'];
      $instance['post'] = intval($new_instance['post']);
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
		'custom_title'      => '',
        'custom_summary'    => '',
        'person_name'      => '',
        'person_role'      => '',
        'person_email'     => '',
        'btn_person'       => false,
        'person_image'     => '',
        'image_size'       => '',
        'post'             => null
      ));
		$custom_title = esc_attr( $instance['custom_title'] );
      $custom_summary = esc_attr( $instance['custom_summary'] );
	  
      $person_name = esc_attr( $instance['person_name'] );
      $person_role = esc_attr( $instance['person_role'] );
      $person_email = esc_attr( $instance['person_email'] );
      $btn_person = esc_attr( $instance['btn_person'] );
      $person_image = esc_attr( $instance['person_image'] );
      $post = (int) $instance['post'];
      $image_size = esc_attr( $instance['image_size'] );
      ?>

      <section id="widget_Featured_Person_ctm_adm<?php echo $this->number ?>">
	  	<p>
      <label for="<?php echo $this->get_field_id('custom_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
		  <input class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>" name="<?php echo $this->get_field_name('custom_title'); ?>" type="text" value="<?php echo $custom_title; ?>" />
		</p>
		<p>
		  <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>"><?php _e( 'Sub Title:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary' ); ?>" name="<?php echo $this->get_field_name( 'custom_summary' ); ?>" style="min-height: 150px"><?php echo $custom_summary; ?></textarea>
		</p>
        <!-- SELECT PERSON -->
        <p>
          <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Person:', 'wp_widget_plugin'); ?></label>
          <?php printf('<select class="widefat form-control" id="%s" name="%s">', $this->get_field_id('post'), $this->get_field_name('post')); ?>
            <?php foreach (get_posts('post_type=person&posts_per_page=-1') as $item): ?>
              <?php printf('<option value="%s" %s>%s</option>', $item->ID, selected( $item->ID, $post), trim($item->post_title)); ?>
            <?php endforeach; ?>
          </select>
        </p>
        <!-- CUSTOM PERSON BTN -->
          <p>
            <label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image size:', 'wp_widget_plugin'); ?></label>
            <select class="widefat form-control" id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
              <option value="sm" <?php echo ($image_size == 'sm') ? 'selected' : '' ?>>Small image thumbnail</option>
              <option value="big" <?php echo ($image_size == 'big') ? 'selected' : '' ?>>Big image thumbnail</option>
            </select>
          </p>
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('btn_person'); ?>" name="<?php echo $this->get_field_name('btn_person'); ?>" type="checkbox" <?php checked($btn_person); ?>  />
            <label for="<?php echo $this->get_field_id('btn_person'); ?>">Custom Person</label>
          </p>
          <!-- PERSON NAME -->
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('person_name'); ?>"><?php _e('Name:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('person_name'); ?>" name="<?php echo $this->get_field_name('person_name'); ?>" type="text" value="<?php echo $person_name; ?>" />
          </p>
          <!-- PERSON SUBTITLE -->
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('person_role'); ?>"><?php _e('Role:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('person_role'); ?>" name="<?php echo $this->get_field_name('person_role'); ?>" type="text" value="<?php echo $person_role; ?>" />
          </p>
          <!-- PERSON SUBTITLE -->
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('person_email'); ?>"><?php _e('Email:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('person_email'); ?>" name="<?php echo $this->get_field_name('person_email'); ?>" type="text" value="<?php echo $person_email; ?>" />
          </p>
          <!-- PERSON IMAGE -->
          <p class="tohide">
            <label for="<?php echo $this->get_field_id( 'person_image' ) ?>">Photo: </label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'person_image' ) ?>" name="<?php echo $this->get_field_name( 'person_image' ) ?>" value="<?php echo esc_attr( $person_image ); ?>">
            <button id="<?php echo $this->get_field_id( 'person_image' ) ?>" class="button select-media custommedia">Add Media</button>
          </p>
        </div>
      </section>
      <script>
        jQuery(document).ready(function($){
          $('#widget_Featured_Person_ctm_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })
          $('#widget_Featured_Person_ctm_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
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
    register_widget( 'Featured_Person' );
  });

endif;
