<?php

if ( !class_exists('Featured_Post') ):

class Featured_Post extends WP_Widget {
  public $template = 'includes/widgets/featured-post/template.php';

  function Featured_Post() {
    $widget_ops = array(
      'classname' => 'widget_featured_post_ctm',
      'description' => __( "Highlighted Post", 'idiit-theme'),
      'panels_groups' => array('id-theme')
    );
    parent::__construct( false, __('ID Highlighted Post', 'idiit-theme'), $widget_ops );
    add_action( 'admin_footer', array( $this, 'media_fields' ) );
    add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
  }

  function widget( $args, $instance ) {
    extract( $args );
    $show_img = isset($instance['show_img']) ? $instance['show_img'] : false;
    $custom_title = isset($instance['custom_title']) ? $instance['custom_title'] : false;
    $custom_summary = isset($instance['custom_summary']) ? $instance['custom_summary'] : false;
    $custom_image = isset($instance['custom_image']) ? $instance['custom_image'] : false;
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
    $instance['custom_title_text'] = strip_tags($new_instance['custom_title_text']);
    $instance['custom_summary_text'] = strip_tags($new_instance['custom_summary_text']);
    $instance['show_img'] = (bool) $new_instance['show_img'];
    $instance['custom_title'] = (bool) $new_instance['custom_title'];
    $instance['custom_summary'] = (bool) $new_instance['custom_summary'];
    $instance['custom_image'] = (bool) $new_instance['custom_image'];
    $instance['post'] = intval($new_instance['post']);
    $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'custom_title_text'      => '',
      'custom_summary_text'    => '',
      'show_img'               => false,
      'custom_title'           => false,
      'custom_summary'         => false,
      'custom_image'           => false,
      'image'                  => '',
      'post'                   => null
    ));

    $custom_title_text = esc_attr( $instance['custom_title_text'] );
    $custom_summary_text = esc_attr( $instance['custom_summary_text'] );
    $show_img = esc_attr( $instance['show_img'] );
    $custom_title = esc_attr( $instance['custom_title'] );
    $custom_summary = esc_attr( $instance['custom_summary'] );
    $custom_image = esc_attr( $instance['custom_image'] );
    $image = esc_attr( $instance['image'] );
    $post = (int) $instance['post'];
    ?>

<section id="widget_featured_post_ctm_adm<?php echo $this->number ?>">
    <p>
      <input  id="<?php echo $this->get_field_id('show_img'); ?>" name="<?php echo $this->get_field_name('show_img'); ?>" type="checkbox" <?php checked($show_img); ?>  />
      <label for="<?php echo $this->get_field_id('show_img'); ?>">Show Post Featured Image</label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Post', 'wp_widget_plugin'); ?></label>
      <?php printf('<select class="widefat form-control" id="%s" name="%s">', $this->get_field_id('post'), $this->get_field_name('post')); ?>
        <?php foreach (get_posts('post_type=post&posts_per_page=-1') as $item): ?>
          <?php printf('<option value="%s" %s>%s</option>', $item->ID, selected( $item->ID, $post), trim($item->post_title)); ?>
        <?php endforeach; ?>
      </select>
    </p>
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
      <input class="checkbox-controller" id="<?php echo $this->get_field_id('custom_image'); ?>" name="<?php echo $this->get_field_name('custom_image'); ?>" type="checkbox" <?php checked($custom_image); ?>  />
      <label for="<?php echo $this->get_field_id('custom_image'); ?>">Custom Image</label>
    </p>
    <p class="tohide">
      <label for="<?php echo $this->get_field_id( 'image' ) ?>">Media Upload</label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'image' ) ?>" name="<?php echo $this->get_field_name( 'image' ) ?>" value="<?php echo esc_attr( $image ); ?>">
     <button id="<?php echo $this->get_field_id( 'image' ) ?>" class="button select-media custommedia">Add Media</button>
   </p>
   </div>
</section>
   <script>
      jQuery(document).ready(function($){
        $('#widget_featured_post_ctm_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
        $('#widget_featured_post_ctm_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
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
  register_widget( 'Featured_Post' );
});

endif;
