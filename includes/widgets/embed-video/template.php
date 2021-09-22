<?php 
/**
 * A widget that lets you embed video.
 */
class myvideo extends WP_Widget {
	function __construct() {
		parent::__construct(
			'siteorigin-panels-embedded-video',
			__( 'AAA VIDEO', 'siteorigin-panels' ),
			array(
				'description' => __( 'Embeds a video.', 'siteorigin-panels' ),
			)
		);
	}

	/**
	 * Display the video using
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		$embed = new WP_Embed();

		if(!wp_script_is('fitvids'))
			wp_enqueue_script('fitvids', get_template_directory_uri().'includes/widgets/embed-video/js/jquery.fitvids.js', array('jquery'), SITEORIGIN_PANELS_VERSION);

		if(!wp_script_is('siteorigin-panels-embedded-video'))
			wp_enqueue_script('siteorigin-panels-embedded-video', get_template_directory_uri().'includes/widgets/embed-video/js/embedded-video.js', array('jquery', 'fitvids'), SITEORIGIN_PANELS_VERSION);

		echo $args['before_widget'];
		?><div class="siteorigin-fitvids"><?php echo $embed->run_shortcode( '[embed]' . $instance['video'] . '[/embed]' ) ?></div><?php
		echo $args['after_widget'];
	}

	/**
	 * Display the embedded video form.
	 *
	 * @param array $instance
	 * @return string|void
	 */
	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'video' => '',
		) );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'video' ) ?>"><?php _e( 'Video', 'siteorigin-panels' ) ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'video' ) ?>" id="<?php echo $this->get_field_id( 'video' ) ?>" value="<?php echo esc_attr( $instance['video'] ) ?>" />
		</p>
		<?php
	}

	function update( $new, $old ) {
		$new['video'] = str_replace( 'https://', 'http://', $new['video'] );
		return $new;
	}
}
function siteorigin_panels_widgets_init(){
	register_widget('myvideo');
}
add_action('widgets_init', 'siteorigin_panels_widgets_init');
