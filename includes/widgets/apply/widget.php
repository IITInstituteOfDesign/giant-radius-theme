<?php

if ( !class_exists('Apply') ):

  class Apply extends WP_Widget {
    public $template = 'includes/widgets/apply/template.php';

    function Apply() {
      $widget_ops = array( 'classname' => 'widget_apply', 'description' => __( "Apply Program Widget", 'idiit-theme' ), 'panels_groups' => array('id-theme'));
      parent::__construct( false, __('Apply Widget', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      $btn_offset = isset($instance['btn_offset']) ? $instance['btn_offset'] : false;
      include(locate_template( $this->template ));
    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['subtitle'] = strip_tags($new_instance['subtitle']);
      $instance['description'] = $new_instance['description'];
      $instance['style'] = $new_instance['style'];
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['btn_offset'] = (bool) $new_instance['btn_offset'];
      $instance['btn_text'] = $new_instance['btn_text'];
      $instance['btn_url'] = $new_instance['btn_url'];
	  $instance['url_target'] = $new_instance['url_target'];
      $instance['btn_position'] = $new_instance['btn_position'];
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'           => '',
        'subtitle'        => '',
        'description'     => '',
        'style'           => 'style-1',
        'show_btn'        => false,
        'btn_offset'      => false,
        'btn_text'        => '',
        'btn_url'         => get_field('button_url', 'option'),
		'url_target'        => '',
        'btn_position'    => '',
      ));

      $title = esc_attr( $instance['title'] );
      $subtitle = esc_attr( $instance['subtitle'] );
      $description = esc_attr( $instance['description'] );
      $style = $instance['style'];
      $show_btn = $instance['show_btn'];
      $btn_offset = $instance['btn_offset'];
      $btn_text = $instance['btn_text'];
      $btn_url = $instance['btn_url'];
	  $url_target = $instance['url_target'];
      $btn_position = $instance['btn_position'];
      ?>
      <section id="widget_apply_adm<?php echo $this->number ?>">
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'wp_widget_plugin'); ?></label>
          <textarea name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" class="widefat"><?php echo $description; ?></textarea>
        </p>
        <div style="margin: 20px 0 40px 0">
          <label>Box Style</label>
          <div class="stock-images">
            <div>
              <input id="<?php echo $this->get_field_id('style'); ?>1" name="<?php echo $this->get_field_name('style'); ?>" value="style-1" type="radio" <?php echo $instance['style'] == 'style-1' ? 'checked' : '' ?> />
              <label for="<?php echo $this->get_field_id('style'); ?>1">
                <div class="image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/w_apply_1.png)"></div>
              </label>
            </div>
            <div>
              <input id="<?php echo $this->get_field_id('style'); ?>2" name="<?php echo $this->get_field_name('style'); ?>" value="style-2" type="radio" <?php echo $instance['style'] == 'style-2' ? 'checked' : '' ?> />
              <label for="<?php echo $this->get_field_id('style'); ?>2">
                <div class="image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/w_apply_2.png)"></div>
              </label>
            </div>
            <div>
              <input id="<?php echo $this->get_field_id('style'); ?>3" name="<?php echo $this->get_field_name('style'); ?>" value="style-3" type="radio" <?php echo $instance['style'] == 'style-3' ? 'checked' : '' ?> />
              <label for="<?php echo $this->get_field_id('style'); ?>3">
                <div class="image" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/w_apply_3.png)"></div>
              </label>
            </div>
          </div>
        </div>
        <!-- Button -->
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
		  <p class="tohide">
            <label for="<?php echo $this->get_field_id('url_target'); ?>">
            <input id="<?php echo $this->get_field_id('url_target'); ?>" name="<?php echo $this->get_field_name('url_target'); ?>" type="checkbox" value="1" <?php if($url_target=="1") echo 'checked'; ?> /> <?php _e('Open in new window', 'wp_widget_plugin'); ?></label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('btn_position'); ?>"><?php _e('Button Position', 'wp_widget_plugin'); ?></label>
            <select name="<?php echo $this->get_field_name('btn_position'); ?>" id="<?php echo $this->get_field_id('btn_position'); ?>">
              <option value="left" <?php echo $btn_position == 'left' ? 'selected' : '' ?>>Left</option>
              <option value="center" <?php echo $btn_position == 'center' ? 'selected' : '' ?>>Center</option>
              <option value="right" <?php echo $btn_position == 'right' ? 'selected' : '' ?>>Right</option>
            </select>
          </p>
          <p class="tohide">
            <input id="<?php echo $this->get_field_id('btn_offset'); ?>" name="<?php echo $this->get_field_name('btn_offset'); ?>" type="checkbox" <?php checked($btn_offset); ?>  />
            <label for="<?php echo $this->get_field_id('btn_offset'); ?>">Offset bottom</label>
          </p>
        </div>

      </section>
      <script>
        jQuery(document).ready(function($){
          tinyMCE.init({
            selector: '#widget_apply_adm<?php echo $this->number ?> #<?php echo $this->get_field_id('description'); ?>',
            height : "100",
            dialog_type:"modal",
            plugins:'link colorpicker lists',
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
              })
              ;}
            });


          $('#widget_apply_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })
          $('#widget_apply_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })
        });
      </script>
      <style>
      .mce-tinymce{
        border: 1px solid #ddd !important;
      }

      .stock-images{
        display: flex;
      }
      .stock-images div{
        margin-right: 15px
      }
      .stock-images input[type="radio"]{
        pointer-events: none;
        opacity: 0;
      }
      .stock-images .image {
        opacity: 1;
        width: 180px;
        height: 180px;
        background-position: center center;
        background-color: gray;
      }
      .stock-images .image:hover {
        opacity: 1;
      }
      .stock-images [type="radio"] + label:before,
      .stock-images [type="radio"] + label:after {
        display: none;
      }
      .stock-images [type="radio"] + label {
        width: 180px;
        height: 180px;
        padding: 0;
      }
      .stock-images [type="radio"]:not(:checked) + label .image {
        border: 3px solid white;
      }
      .stock-images [type="radio"]:checked + label .image {
        border: 3px solid #394e6d;
        opacity: 1;
      }

    </style>
    <?php
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'Apply' );
});

endif;
