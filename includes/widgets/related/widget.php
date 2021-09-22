<?php

if ( !class_exists('Related_Posts') ):

class Related_Posts extends WP_Widget {
	public $template = 'includes/widgets/related/template.php';

	function Related_Posts() {
		$widget_ops = array(
			'classname' => 'widget_related',
			'description' => __( "Show posts related to the current page.", 'idiit-theme')
			);

		parent::__construct( false, __('Related Posts', 'idiit-theme'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$collapse = isset($instance['collapse']) ? $instance['collapse'] : 0;

		$query_args = array(
			'post_type' => 'any',
			'posts_per_page' => -1,
			'ignore_sticky_posts' => true
		);

		if (isset($instance['query_args'])) {
			$query_args = array_merge( $query_args, $instance['query_args'] );
		}

		$query = new WP_Query( $query_args );
		include(locate_template( $this->template ));
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_type'] = strip_tags($new_instance['post_type']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array)$instance, array(
			'title'       => 'Related Posts',
			'post_type'   => null,
			'limit'       => 6
		));

		$title = esc_attr( $instance['title'] );
		$post_type = esc_attr( $instance['post_type'] );
		$limit = esc_attr( $instance['limit'] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type', 'wp_widget_plugin'); ?></label>
			<select class="widefat form-control" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
				<?php foreach (get_post_types(array('public' => true), 'objects') as $cpt): ?>
					<option value="<?php echo $cpt->name; ?>"<?php selected($cpt->name, $post_type); ?>>
						<?php echo $cpt->label; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" step="1" max="20" min="1" />
		</p>

		<?php
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Related_Posts' );
});

endif;
