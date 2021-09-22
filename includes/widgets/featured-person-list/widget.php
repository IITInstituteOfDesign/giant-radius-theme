<?php

if ( !class_exists('Featured_Person_List') ):

  class Featured_Person_List extends WP_Widget {
    public $template = 'includes/widgets/featured-person-list/template.php';

    function Featured_Person_List() {
      $widget_ops = array(
        'classname' => 'widget_Featured_Person_List_ctm',
        'description' => __( "Persons List", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Person List', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );

    // $query = new WP_Query( array( 'p' => $instance['post'], 'ignore_sticky_posts' => true, 'post_type' => 'any' ) );
      if ($instance['post']) {
        include(locate_template( $this->template ));
      }
    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['desc'] = strip_tags($new_instance['desc']);
      $instance['post'] = $new_instance['post'];
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'title'   => '',
        'desc' => '',
        'post'    => array()
      ));

      $title = $instance['title'];
      $desc = $instance['desc'];
      $post = $instance['post'];
      ?>

      <section id="widget_Featured_Person_List_ctm_adm<?php echo $this->number ?>">
        <div class="items">
          <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>
          <p>
            <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description', 'wp_widget_plugin'); ?></label>
            <textarea name="<?php echo $this->get_field_name('desc'); ?>" id="<?php echo $this->get_field_id('desc'); ?>" class="widefat"><?php echo $desc; ?></textarea>
          </p>
          <!-- SELECT PERSON -->
          <p class="person-select">
            <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Person:', 'wp_widget_plugin'); ?></label>
            <?php printf('<select multiple id="%s" name="%s" placeholder="Pick some people...">', $this->get_field_id('post'), $this->get_field_name('post')); ?>
            <?php foreach (get_posts('post_type=person&posts_per_page=-1') as $item): ?>
              <?php if (isset($instance['post']) && $instance['post'] == $item->ID  || isset($instance['post']) && in_array($item->ID, $instance['post'])) {
                $s = 'selected="selected"';
              }else{
                $s = '';
              } ?>
              <?php echo "<option value=".$item->ID." ".$s.">".trim($item->post_title)."</option>"; ?>
            <?php endforeach; ?>
          </select>
        </p>
      </div>
    </section>
    <script>
      jQuery(document).ready(function($){
        tinyMCE.init({
          selector: '#widget_Featured_Person_List_ctm_adm<?php echo $this->number ?> #<?php echo $this->get_field_id('desc'); ?>',
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

        $('#widget_Featured_Person_List_ctm_adm<?php echo $this->number ?> .person-select select').selectize({
          maxItems: null,
        });
      });
    </script>
    <style>
    
    .mce-tinymce{
      border: 1px solid #ddd !important;
    }
  </style>

  <?php
}
}

add_action( 'widgets_init', function() {
  register_widget( 'Featured_Person_List' );
});

endif;
