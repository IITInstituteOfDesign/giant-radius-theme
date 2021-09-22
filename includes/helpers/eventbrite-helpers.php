<?php 
function eb_is_multiday_event($start, $end) {
	// Set date variables for comparison.
	$start_date = mysql2date( 'Ymd', $start );
	$end_date = mysql2date( 'Ymd', $end );

	// Return true if they're different, false otherwise.
	return ( $start_date !== $end_date );
}

function eb_event_time($start, $end) {
	// Collect our formats from the admin.
	$date_format = get_option( 'date_format' );
	$time_format = get_option( 'time_format' );
	$combined_format = apply_filters( 'eventbrite_date_time_format', $date_format . ', ' . $time_format, $date_format, $time_format );

	// Determine if the end time needs the date included (in the case of multi-day events).
	$end_time = ( eb_is_multiday_event($start, $end) )
	? mysql2date( $combined_format, $end )
	: mysql2date( $time_format, $end );

	// Assemble the full event time string.
	$event_time = sprintf(
		_x( '%1$s - %2$s', 'Event date and time. %1$s = start time, %2$s = end time', 'eventbrite_api' ),
		esc_html( mysql2date( $combined_format, $start ) ),
		esc_html( $end_time )
	);

	return $event_time;
}

function eb_slug() {
	$url = sprintf( '%1$s-%2$s/',
			sanitize_title( get_post()->post_title ),               // event-title
			absint( get_post()->ID )                                // event ID
		);
	return $url;
}

function eb_event_url() {
	$url = sprintf( '%1$s/%2$s/%3$s',
		esc_url( home_url() ),
		'events',
		eb_slug()
	);
	return $url;
}