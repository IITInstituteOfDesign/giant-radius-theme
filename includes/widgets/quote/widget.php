<?php 
/**
* Adds Quote widget
*/
class Quote_Widget extends WP_Widget {

  /**
  * Register widget with WordPress
  */
  function __construct() {
    parent::__construct(
      'quote_widget', // Base ID
      esc_html__( 'Quote', 'idiit-theme' ), // Name
      array( 'description' => esc_html__( 'A custom quote widget', 'idiit-theme' ), ) // Args
    );
    add_action( 'admin_footer', array( $this, 'media_fields' ) );
    add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
  }

  /**
  * Widget Fields
  */
  private $widget_fields = array(
    array(
      'label' => 'Quote',
      'id' => 'quote_78814',
      'type' => 'textarea',
    ),
    array(
      'label' => 'Name',
      'id' => 'name_92155',
      'type' => 'text',
    ),
    array(
      'label' => 'Image',
      'id' => 'image_77612',
      'type' => 'media',
    ),
  );

  /**
  * Front-end display of widget
  */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    // Output generated fields
    ?>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif:500i" rel="stylesheet">
    <div class="quote_container" style="<?php echo isset($instance['image_77612']) ? 'background-image:url('.$instance['image_77612'].')' : '' ; ?>">
      <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="512.5" height="512.5" viewBox="0 0 512.5 512.5" ><path d="M112.5 208.25c61.86 0 112 50.15 112 112s-50.14 112-112 112-112-50.15-112-112l-.5-16c0-123.71 100.29-224 224-224v64a158.95 158.95 0 0 0-113.14 46.86 163.43 163.43 0 0 0-15.91 18.51c5.72-.9 11.58-1.37 17.55-1.37zm288 0c61.85 0 112 50.15 112 112s-50.15 112-112 112-112-50.15-112-112l-.5-16c0-123.71 100.29-224 224-224v64a158.95 158.95 0 0 0-113.14 46.86 162.42 162.42 0 0 0-15.91 18.51c5.72-.9 11.58-1.37 17.55-1.37z"/></svg></div>
      <p class="quote"><?php echo $instance['quote_78814'] ?></p>
      <p class="name"><?php echo $instance['name_92155'] ?></p>
    </div>
    <?php
    // echo '<p>'.$instance['quote_78814'].'</p>';
    // echo '<p>'.$instance['name_92155'].'</p>';
    // echo '<p>'.$instance['image_77612'].'</p>';
    
    echo $args['after_widget'];
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

  /**
  * Back-end widget fields
  */
  public function field_generator( $instance ) {
    $output = '';
    foreach ( $this->widget_fields as $widget_field ) {
      $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $widget_field['default'], 'textdomain' );
      switch ( $widget_field['type'] ) {
        case 'media':
        $output .= '<p>';
        $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
        $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_url( $widget_value ).'">';
        $output .= '<button id="'.$this->get_field_id( $widget_field['id'] ).'" class="button select-media custommedia">Add Media</button>';
        $output .= '</p>';
        break;
        case 'textarea':
        $output .= '<p>';
        $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
        $output .= '<textarea class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" rows="6" cols="6" value="'.esc_attr( $widget_value ).'">'.$widget_value.'</textarea>';
        $output .= '</p>';
        break;
        default:
        $output .= '<p>';
        $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
        $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
        $output .= '</p>';
      }
    }
    echo $output;
  }

  public function form( $instance ) {
    $this->field_generator( $instance );
  }

  /**
  * Sanitize widget form values as they are saved
  */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    foreach ( $this->widget_fields as $widget_field ) {
      switch ( $widget_field['type'] ) {
        case 'checkbox':
        $instance[$widget_field['id']] = $_POST[$this->get_field_id( $widget_field['id'] )];
        break;
        default:
        $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
      }
    }
    return $instance;
  }
} // class Quote_Widget

// register Quote widget
function register_quote_widget() {
  register_widget( 'Quote_Widget' );
}
add_action( 'widgets_init', 'register_quote_widget' );