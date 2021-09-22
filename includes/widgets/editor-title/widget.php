<?php

if ( !class_exists('Editor_Title') ):

  class Editor_Title extends WP_Widget {
    public $template = 'includes/widgets/editor-title/template.php';

    function Editor_Title() {
      $widget_ops = array(
        'classname' => 'widget_Editor_Title_ctm',
        'description' => __( "Display the post title", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('Post Title', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );

    // $query = new WP_Query( array( 'p' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'any' ) );
      include(locate_template( $this->template ));
    }



    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['custom_title'] = strip_tags($new_instance['custom_title']);
      $instance['btn_custom_title'] = (bool) $new_instance['btn_custom_title'];
      return $instance;
    }


      // $instance['custom_pdf'] = ( ! empty( $new_instance['custom_pdf'] ) ) ? $new_instance['custom_pdf'] : '';

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'btn_custom_title'      => false,
        'custom_title'          => '',
      ));

      $custom_title = esc_attr( $instance['custom_title'] );
      $btn_custom_title = esc_attr( $instance['btn_custom_title'] );
      ?>

      <section id="Editor_Title_ctm_adm">
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('btn_custom_title'); ?>" name="<?php echo $this->get_field_name('btn_custom_title'); ?>" type="checkbox" <?php checked($btn_custom_title); ?>  />
            <label for="<?php echo $this->get_field_id('btn_custom_title'); ?>">Show custom title</label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('custom_title'); ?>"><?php _e('Custom Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>" name="<?php echo $this->get_field_name('custom_title'); ?>" type="text" value="<?php echo $custom_title; ?>" />
          </p>
        </div>
      </section>
      <script>
        jQuery(document).ready(function($){
          $('#Editor_Title_ctm_adm .checkbox-controller').each(function( index, element ){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })
          $('#Editor_Title_ctm_adm .checkbox-controller').on('change', function(){
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
    register_widget( 'Editor_Title' );
  });

endif;
