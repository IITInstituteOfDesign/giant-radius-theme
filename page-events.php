<?php

global $wp_query;
if (isset($wp_query->query_vars['custom_event'])) {
	$eventq = get_query_var( 'custom_event' );
	$event = explode('-', $eventq);
	$eventID = end($event);
	if (is_numeric($eventID)) {
		$api_request = eventbrite_get_event($eventID, true);
		$organizerID = $api_request->events[0]->organizer->id;
		if ($organizerID == 2741168798) {
			$IDevent = true;
		}else{
			$IDevent = false;
		}
	}
	
	if (is_numeric($eventID) && $IDevent == true) {
		get_template_part( 'events/events-single' );
	}else{
		$args = array(
			'post_type' => 'page',
			'name' => $eventq
		);
		error_log($eventq);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ($the_query->have_posts()) : $the_query->the_post();
				get_template_part( 'events/events-child' );
			endwhile;
			wp_reset_postdata();
		} else {
			error_log('top if');
			wp_redirect( home_url() );
			exit;
		}
	}
}else{
	$events = new Eventbrite_Query(
		apply_filters( 'eventbrite_query_args',
			array(
				'display_private' => true,
				'status' => 'live',
				'limit' => 1,
			)
		)
	);
	if ( $events->have_posts() ) :
		get_template_part( 'events/events-archive' );
	else:
		error_log('else');
		wp_redirect( home_url() );
		exit;
	endif;
	wp_reset_postdata();
}
?>
