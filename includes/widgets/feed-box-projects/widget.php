<?php

if ( !class_exists('Feed_Box_Projects') ):

  class Feed_Box_Projects extends WP_Widget {
    public $template = 'includes/widgets/feed-box-projects/template.php';

    function Feed_Box_Projects() {
      $widget_ops = array(
        'classname' => 'widget_feed_box_projects',
        'description' => __( "A list of Projects for homepage use", 'idiit-theme'),
        'panels_groups' => array('id-theme')
      );
      parent::__construct( false, __('ID Homepage Projects', 'idiit-theme'), $widget_ops );
    }

    function widget( $args, $instance ) {
      extract( $args );
      $show_recent = isset($instance['show_recent']) ? $instance['show_recent'] : false;
      $featured = isset($instance['featured']) ? $instance['featured'] : false;

      if (isset($instance['featured']) && isset($instance['post'])) {
        foreach ($instance['post'] as $key => $value) {
          $instance['post'][$key] = intval($value);
        }   
        $query_args = array(
          'post__in' => $instance['post'],
          'ignore_sticky_posts' => true,
          'post_type' => 'project'
        );
      }else{
        if ($instance['limit']) {
          $limit = intval($instance['limit']);
        }else{
          $limit = 4;
        }
        $query_args = array(
          'orderby' => 'ASC',
          'post_type' => 'project',
          'posts_per_page' => $limit
        );
      }

      $query = new WP_Query( $query_args );
      if ( $query->have_posts() ){
        include(locate_template( $this->template ));
      }

      wp_reset_postdata();


    }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['limit'] = strip_tags($new_instance['limit']);
      $instance['show_recent'] = (bool) $new_instance['show_recent'];
      $instance['featured'] = (bool) $new_instance['featured'];
      $instance['post'] = $new_instance['post'];
      return $instance;
    }

    function form( $instance ) {
      $instance = wp_parse_args( (array)$instance, array(
        'limit'         => '',
        'featured'      => false,
        'show_recent'   => false,
        'post'          => null,
      ));

      $limit = esc_attr( $instance['limit'] );
    // $event = esc_attr( $instance['event'] );
      $show_recent = esc_attr( $instance['show_recent'] );
      $featured = esc_attr( $instance['featured'] );
      $post = $instance['post'];

      ?>

      <section id="widget_feed_box_projects_adm<?php echo $this->number ?>">
        <div>
          <p>
            <input class="checkbox-controller" id="<?php echo $this->get_field_id('featured'); ?>" name="<?php echo $this->get_field_name('featured'); ?>" type="checkbox" <?php checked($featured); ?>  />
            <label for="<?php echo $this->get_field_id('featured'); ?>">Show custom projects</label>
          </p>
          <p class="tohide">
            <label for="<?php echo $this->get_field_id('post'); ?>"><?php _e('Select projects to display:', 'wp_widget_plugin'); ?></label>
            <?php printf('<select class="widefat form-control selectize" id="%s" name="%s" multiple>', $this->get_field_id('post'), $this->get_field_name('post')); ?>
            <?php foreach (get_posts('post_type=project&posts_per_page=-1') as $item): ?>
              <?php if (isset($post) && in_array($item->ID, $post)) {
                $s = 'selected';
              }else{
                $s = '';
              } ?>
              <?php print('<option value="'.$item->ID.'" '.$s.'>'.trim($item->post_title).'</option>') ?>
            <?php endforeach; ?>
          </select>
        </p>
      </div>
      <div>
        <p>
          <input class="checkbox-controller" id="<?php echo $this->get_field_id('show_recent'); ?>" name="<?php echo $this->get_field_name('show_recent'); ?>" type="checkbox" <?php checked($show_recent); ?>  />
          <label for="<?php echo $this->get_field_id('show_recent'); ?>">Show most recent projects</label>
        </p>
        <p class="tohide">
          <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Max number of projects to show:', 'wp_widget_plugin'); ?></label>
          <input type="number" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $limit; ?>" />
        </p>
      </div>




      <script>
        jQuery(document).ready(function($){
          $('#widget_feed_box_projects_adm<?php echo $this->number ?> select').selectize({
            maxItems: null,
            plugins: ['drag_drop'],
          });
          $('#widget_feed_box_projects_adm<?php echo $this->number ?> .checkbox-controller').each(function( index, element ){
            if ($(this).is(":checked")) {
              $(this).parent().parent().find('.tohide').show();
            }else{
              $(this).parent().parent().find('.tohide').hide();
            }
          })
          $('#widget_feed_box_projects_adm<?php echo $this->number ?> .checkbox-controller').on('change', function(){
          // $('.checkbox-controller').not(this).prop('checked', false);
          var othercheck = $('#widget_feed_box_projects_adm<?php echo $this->number ?> .checkbox-controller').not(this);
          othercheck.parent().parent().find('.tohide').hide();  
          othercheck.prop('checked', false)
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
  register_widget( 'Feed_Box_Projects' );
});

endif;
