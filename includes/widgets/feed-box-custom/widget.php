<?php
if ( !class_exists('Feed_Box_Custom') ):
  class Feed_Box_Custom extends WP_Widget {
    public $template = 'includes/widgets/feed-box-custom/template.php';
    function Feed_Box_Custom() {
      $widget_ops = array(
        'classname' => 'widget_feed_box_custom',
        'description' => __( "A block of text for homepage use", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Homepage Custom Box', 'idiit-theme'), $widget_ops );
    }
    function widget( $args, $instance ) {
      extract( $args );
      $show_btn = isset($instance['show_btn']) ? $instance['show_btn'] : false;
      $target_new = isset($instance['target_new']) ? $instance['target_new'] : false;
      include(locate_template( $this->template ));
    }
    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['text'] = strip_tags($new_instance['text']);
      $instance['show_btn'] = (bool) $new_instance['show_btn'];
      $instance['target_new'] = (bool) $new_instance['target_new'];
      $instance['btn_text'] = strip_tags($new_instance['btn_text']);
      $instance['btn_url'] = strip_tags($new_instance['btn_url']);
      $instance['btn_position'] = strip_tags($new_instance['btn_position']);
      $instance['type'] = strip_tags($new_instance['type']);

      if ($instance['type'] == 'text'){
        $instance['type_list'] = '';
        $instance['type_list2'] = '';
      }elseif ($instance['type'] == 'list' || $instance['type'] == 'list2'){
        $instance['text'] = '';

      // TYPE LIST
        $del = 0;
        foreach ($new_instance['type_list'] as $key => $value) {
          if ($value[title] == '' && $value[url] == '' && $value[text] == '') {
            unset($new_instance['type_list'][$key]);
            $del = 1;
          }
        }
        if ($del == 1) {
          $instance['type_list'] = array_values($new_instance['type_list']);
        }else{
          $instance['type_list'] = $new_instance['type_list'];
        }
      }
      // elseif ($instance['type'] == 'list2') {
      //   $instance['text'] = '';
      //   $instance['type_list'] = '';
      // // TYPE LIST2
      //   $del = 0;
      //   foreach ($new_instance['type_list2'] as $key => $value) {
      //     if ($value[title] == '' && $value[url] == '' && $value[text] == '') {
      //       unset($new_instance['type_list2'][$key]);
      //       $del = 1;
      //     }
      //   }
      //   if ($del == 1) {
      //     $instance['type_list2'] = array_values($new_instance['type_list2']);
      //   }else{
      //     $instance['type_list2'] = $new_instance['type_list2'];
      //   }
      // }





      return $instance;
    }
    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'         => '',
        'show_btn'      => false,
        'target_new'    => false,
        'text'          => '',
        'btn_text'      => '',
        'btn_url'       => '',
        'btn_position'  => 'left',
        'type'          => 'text',
        'type_list'     => array(),
      ));

      $title = esc_attr( $instance['title'] );
      $show_btn = esc_attr( $instance['show_btn'] );
      $text = esc_attr( $instance['text'] );
      $btn_text = esc_attr( $instance['btn_text'] );
      $btn_url = esc_attr( $instance['btn_url'] );
      $btn_position = esc_attr( $instance['btn_position'] );
      $target_new = esc_attr( $instance['target_new'] );
      $type = esc_attr( $instance['type'] );
      $type_list = $instance['type_list'];
      ?>
      <section id="widget_feed_box_custom_adm<?php echo $this->number ?>">
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <hr>
        <p>
          <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type', 'wp_widget_plugin'); ?></label>
          <select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
            <option value="text" <?php echo $type == 'text' ? 'selected' : ''; ?>>Text</option>
            <option value="list" <?php echo $type == 'list' ? 'selected' : ''; ?>>List</option>
            <option value="list2" <?php echo $type == 'list2' ? 'selected' : ''; ?>>2 Columns List</option>
          </select>
        </p>
        <p class="type-text">
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text', 'wp_widget_plugin'); ?></label>
          <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" style="min-height: 150px"><?php echo $text; ?></textarea>
        </p>
        <div class="type-list">
          <div class="items">
            <?php foreach ($instance['type_list'] as $key => $value): ?>
              <div class="type-list-item item">
                <p>
                  <label for="<?php echo $this->get_field_id('type_list'); ?>[<?php echo $key; ?>][title]"><?php _e('Title:', 'wp_widget_plugin'); ?></label>
                  <input required class="widefat" id="<?php echo $this->get_field_id('type_list'); ?>[<?php echo $key; ?>][title]" name="<?php echo $this->get_field_name('type_list'); ?>[<?php echo $key; ?>][title]" type="text" value="<?php echo $value[title]; ?>" />
                </p>
                <p>
                  <label for="<?php echo $this->get_field_id('type_list'); ?>[<?php echo $key; ?>][text]"><?php _e('Subtitle:', 'wp_widget_plugin'); ?></label>
                  <textarea name="<?php echo $this->get_field_name('type_list'); ?>[<?php echo $key; ?>][text]" id="<?php echo $this->get_field_id('type_list'); ?>[<?php echo $key; ?>][text]" required><?php echo $value[text]; ?></textarea>
                </p>
                <p>
                  <label for="<?php echo $this->get_field_id('type_list'); ?>[<?php echo $key; ?>][url]"><?php _e('URL:', 'wp_widget_plugin'); ?></label>
                  <input required class="widefat" id="<?php echo $this->get_field_id('type_list'); ?>[<?php echo $key; ?>][url]" name="<?php echo $this->get_field_name('type_list'); ?>[<?php echo $key; ?>][url]" type="text" value="<?php echo $value[url]; ?>" />
                </p>
                <a href="#" class="button-remove button-primary">Remove Item</a>
              </div>
            <?php endforeach; ?>
          </div>
          <a href="#" id="additem-list" class="button-primary">Add item</a>
        </div>
        <hr>
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
            <label for="<?php echo $this->get_field_id('btn_position'); ?>"><?php _e('Button Position', 'wp_widget_plugin'); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name('btn_position'); ?>" id="<?php echo $this->get_field_id('btn_position'); ?>">
              <option value="left" <?php echo $btn_position == 'left' ? 'selected' : ''; ?>>Left</option>
              <option value="center" <?php echo $btn_position == 'center' ? 'selected' : ''; ?>>Center</option>
              <option value="right" <?php echo $btn_position == 'right' ? 'selected' : ''; ?>>Right</option>
            </select>
          </p>
          <p class="tohide">
            <input id="<?php echo $this->get_field_id('target_new'); ?>" name="<?php echo $this->get_field_name('target_new'); ?>" type="checkbox" <?php checked($target_new); ?>  />
            <label for="<?php echo $this->get_field_id('target_new'); ?>">Open in new tab</label>
          </p>
        </div>
      </section>
      <script>
        jQuery(document).ready(function($){
          $(document).on("click", "#widget_feed_box_custom_adm<?php echo $this->number ?> .button-remove", function() {
            $(this).parent().find('input, textarea').val('');
            $(this).parent().hide(500)
          })


          var v = $('#<?php echo $this->get_field_id('type'); ?>').val();
          // alert(v);
          if (v == 'text') {
            $('.type-list').hide();
            // $('.type-list2').hide();
          }else if (v == 'list' || v == 'list2'){
            // $('.type-list2').hide();
            $('.type-text').hide();
          }
          $('#<?php echo $this->get_field_id('type'); ?>').on('change', function(){
            var v = $(this).val();
            if (v == 'text') {
              $('.type-text').show();
              $('.type-list').hide();
              // $('.type-list2').hide();
            }else if (v == 'list' || v == 'list2'){
              $('.type-list').show();
              // $('.type-list2').hide();
              $('.type-text').hide();
            }
          })



          $('#widget_feed_box_custom_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })
          $('#widget_feed_box_custom_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })


          tinyMCE.init({
            selector: '#widget_feed_box_custom_adm<?php echo $this->number ?> textarea',
            oninit : "setPlainText",
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
              })
              ;}
            });

          $('#widget_feed_box_custom_adm<?php echo $this->number ?> #additem-list').on('click', function(e){
            // e.preventDefault();
            var cant = $('#widget_feed_box_custom_adm<?php echo $this->number ?> .type-list-item').length;
            var cantsum = cant+1;
            $('#widget_feed_box_custom_adm<?php echo $this->number ?> .type-list .items').append(`
              <div class="type-list-item item">
              <p>
              <label for="<?php echo $this->get_field_id('type_list'); ?>[`+cantsum+`][title]"><?php _e('Title:', 'wp_widget_plugin'); ?></label>
              <input required class="widefat" id="<?php echo $this->get_field_id('type_list'); ?>[`+cantsum+`][title]" name="<?php echo $this->get_field_name('type_list'); ?>[`+cantsum+`][title]" type="text" value="" />
              </p>
              <p>
              <label for="<?php echo $this->get_field_id('type_list'); ?>[`+cantsum+`][text]"><?php _e('Subtitle:', 'wp_widget_plugin'); ?></label>
              <textarea name="<?php echo $this->get_field_name('type_list'); ?>[`+cantsum+`][text]" id="<?php echo $this->get_field_id('type_list'); ?>[`+cantsum+`][text]" required></textarea>
              </p>
              <p>
              <label for="<?php echo $this->get_field_id('type_list'); ?>[`+cantsum+`][url]"><?php _e('URL:', 'wp_widget_plugin'); ?></label>
              <input required class="widefat" id="<?php echo $this->get_field_id('type_list'); ?>[`+cantsum+`][url]" name="<?php echo $this->get_field_name('type_list'); ?>[`+cantsum+`][url]" type="text" value="" />
              </p>
              <a href="#" class="button-remove button-primary">Remove Item</a>
              </div>
              `);
            setTimeout(function(){
              tinymce.EditorManager.execCommand('mceAddEditor', true, "<?php echo $this->get_field_id('type_list'); ?>["+cantsum+"][text]");
            }, 500);
          })

        });
      </script>
      <style>
      #widget_feed_box_custom_adm<?php echo $this->number ?> .mce-tinymce{
        border: 1px solid #ddd !important;
      }

      #widget_feed_box_custom_adm<?php echo $this->number ?> .item{
        padding: 25px;
        border: 1px solid #d8d8d8;
        border-radius: 0;
        margin-bottom: 25px;
        background-color: #f7f7f7;
      }
    </style>
    <?php
  }
}
add_action( 'widgets_init', function() {
  register_widget( 'Feed_Box_Custom' );
});

endif;
