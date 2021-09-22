<?php

if ( !class_exists('Student_List') ):

	class Student_List extends WP_Widget {

        public $template = 'includes/widgets/students-list/template.php';

        function Student_List()
        {
            $widget_ops = array(
                'classname' => 'widget_Student_List_ctm',
                'description' => __( "Student List", 'idiit-theme'),
                'panels_groups' => array('id-theme')
            );
            parent::__construct( false, __('ID Student List', 'idiit-theme'), $widget_ops );
            add_action( 'admin_footer', array( $this, 'media_fields' ) );
            add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
        }

        function widget( $args, $instance ) {

	        $current_page = get_query_var('paged');
	        $current_page = max( 1, $current_page );

	        $per_page = 60;
	        $offset_start = 0;
	        $offset = ( $current_page - 1 ) * $per_page + $offset_start;

            extract( $args );

            $qryArgs = [
                  'post_type' => 'student',
                  'posts_per_page' => $per_page,
                  'paged' => $current_page,
                  'offset'=> $offset,
                  'meta_query' => ['relation'=>'AND'],
            ];

	        if(count($_POST) > 0) {
		        if (isset($_POST['gradYear']) && $_POST['gradYear'] != '') {
		           $metaClass = [
			           'key'		=> 'class_year',
			           'value'		=> $_POST['gradYear'],
			           'compare'	=> '=',
                   ];

			        array_push($qryArgs['meta_query'], [$metaClass]);
                }
		        if (isset($_POST['dType']) && $_POST['dType'] != '') {
			        $metaDegree = [
				        'key'		=> 'degree_program',
				        'value'		=> $_POST['dType'],
				        'compare'	=> '=',
			        ];

			        array_push($qryArgs['meta_query'], [$metaDegree]);
		        }
	        }

            $query = new WP_Query($qryArgs);

	        $currentUrl = $this->getCurrentUrl();

	        $yearSelect = get_field_object('field_610eaca2df278');
	        $degreeSelect = get_field_object('field_610eae8fdf279');


            include(locate_template( $this->template ));
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['custom_title'] = strip_tags($new_instance['custom_title']);
            $instance['custom_summary'] = ($new_instance['custom_summary']);
            $instance['post'] = intval($new_instance['post']);
            return $instance;
        }

        function form( $instance ) {
            $instance = wp_parse_args( (array)$instance, array(
                'custom_title'      => '',
                'custom_summary'    => ''
            ));
            $custom_title = esc_attr( $instance['custom_title'] );
            $custom_summary = esc_attr( $instance['custom_summary'] );

            ?>

            <section id="widget_Student_List_ctm_adm<?php echo $this->number ?>">
                <p>
                    <label for="<?php echo $this->get_field_id('custom_title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('custom_title'); ?>" name="<?php echo $this->get_field_name('custom_title'); ?>" type="text" value="<?php echo $custom_title; ?>" />
                </p>
                <p>
                    <label for="<?php echo $this->get_field_name( 'custom_summary' ); ?>"><?php _e( 'Sub Title:' ); ?></label>
                    <textarea class="widefat" id="<?php echo $this->get_field_id( 'custom_summary' ); ?>" name="<?php echo $this->get_field_name( 'custom_summary' ); ?>" style="min-height: 150px"><?php echo $custom_summary; ?></textarea>
                </p>
            </section>

            <?php
        }

		function getCurrentUrl() {
			$protocol = is_ssl() ? 'https://' : 'http://';
			return ($protocol) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
    }

    add_action( 'widgets_init', function() {
        register_widget( 'Student_List');
    });
endif;
