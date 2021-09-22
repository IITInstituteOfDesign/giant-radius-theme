<?php

if ( !class_exists('Homepage_Side') ):

class Homepage_Side extends WP_Widget {
  public $template = 'includes/widgets/homepage-side/template.php';

  function Homepage_Side() {
    $widget_ops = array(
      'classname' => 'widget_id_homepage_side',
      'description' => __( "Title and text for Homepage use", 'idiit-theme'),
      'panels_groups' => array('id-theme')
    );
    parent::__construct( false, __('ID Homepage Side', 'idiit-theme'), $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    // $query = new WP_Query( array( 'p' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'any' ) );
    include(locate_template( $this->template ));
    // ();
  }


  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['show_btn'] = (bool) $new_instance['show_btn'];
    $instance['custom_title'] = strip_tags($new_instance['custom_title']);
    $instance['custom_summary'] = ($new_instance['custom_summary']);
    $instance['btn_text'] = strip_tags($new_instance['btn_text']);
    $instance['btn_url'] = strip_tags($new_instance['btn_url']);
    return $instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array)$instance, array(
      'show_btn'          => false,
      'custom_title'      => '',
      'custom_summary'    => '',
      'btn_text'          => '',
      'btn_url'           => '',
    ));

    $show_btn = esc_attr( $instance['show_btn'] );
    $custom_title = esc_attr( $instance['custom_title'] );
    $custom_summary = ( $instance['custom_summary'] );
    $btn_text = esc_attr( $instance['btn_text'] );
    $btn_url = esc_attr( $instance['btn_url'] );
    ?>


<section id="widget_id_homepage_side_adm<?php echo $this->number ?>">
    <p>
      <label for="<?php echo $this->get_field_id('custom_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>" name="<?php echo $this->get_field_name('custom_title'); ?>" type="text" value="<?php echo $custom_title; ?>" />
    </p>
	<div class="siteorigin-widget-field siteorigin-widget-field-type-tinymce siteorigin-widget-field-text">				
      <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>"><?php _e( 'Main Content:' ); ?></label>
	  <div class="siteorigin-widget-tinymce-container"
        <?php
		$editor_id = 'custom_summary';
		$settings = array( 'media_buttons' => true, 'textarea_name' => $this->get_field_name( 'custom_summary' ));
		wp_editor( $custom_summary, $editor_id, $settings );
		?>
    </div>
	</div>
    <!--<p>
      <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>"><?php _e( 'Main Content:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary' ); ?>" name="<?php echo $this->get_field_name( 'custom_summary' ); ?>" style="min-height: 150px"><?php echo $custom_summary; ?></textarea>
    </p>-->
    <div>
    <p>
      <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_btn'); ?>" name="<?php echo $this->get_field_name('show_btn'); ?>" type="checkbox" <?php checked($show_btn); ?>  />
      <label for="<?php echo $this->get_field_id('show_btn'); ?>">Show Button </label>
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
        $('#widget_id_homepage_side_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
          if ($(this).is(":checked")) {
            $(this).parent().parent().find('.tohide').show();
          }else{
            $(this).parent().parent().find('.tohide').hide();
          }
        })
		
		/*tinyMCE.init({
            selector: '#widget_id_homepage_side_adm<?php echo $this->number ?> textarea',
            height : "100",
            dialog_type:"modal",
            plugins:'link colorpicker lists paste',
            theme_advanced_buttons1: "fontselect,fontsizeselect,formatselect,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull",
            theme_advanced_buttons2: "bold,italic,underline,strikethrough,|,forecolor,styleprops,|,link,unlink,|,removeformat,charmap,blockquote,|,outdent,indent,|,undo,redo",
            theme_advanced_buttons3: "",
            theme_advanced_buttons4: "",
            theme_advanced_toolbar_location:"bottom",
            theme_advanced_toolbar_align:"center",
            theme_advanced_resizing:"1",
            theme_advanced_resize_horizontal:"",
            setup : function(ed){
              ed.onChange.add(function(ed){
                tinyMCE.triggerSave();
              });
			  }
            });*/
		
        $('#widget_id_homepage_side_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
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
  register_widget( 'Homepage_Side' );
});

endif;
