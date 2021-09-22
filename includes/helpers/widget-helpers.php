<?php

/**
 * Allows programmatic insertion of widgets on a per-page basis using the
 * registered sidebar-primary configuration options.
 * @param  string $widget_name Name of the widget to insert.
 * @param  array  $instance    Any instance options necessary for that widget.
 * @return null
 */
function the_sidebar_widget( $widget_name, $instance = array() ) {
	$sidebar = $GLOBALS['wp_registered_sidebars']['sidebar-primary'];
	$widget = $GLOBALS['wp_widget_factory']->widgets[$widget_name];
	$allowed = array( 'before_widget', 'after_widget', 'before_title', 'after_title' );
	$args = array_intersect_key( $sidebar, array_flip( $allowed ) );
	$args['before_widget'] = sprintf($args['before_widget'], 'widget_sidebar', $widget->widget_options['classname']);
	the_widget( $widget_name, $instance, $args);
}
