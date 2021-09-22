<?php

add_filter( 'get_previous_post_join', 'idiit_adjacent_events_join', 1, 3 );
add_filter( 'get_next_post_join', 'idiit_adjacent_events_join', 1, 3 );
add_filter( 'get_previous_post_where', 'idiit_adjacent_events_where', 1, 3 );
add_filter( 'get_next_post_where', 'idiit_adjacent_events_where', 1, 3 );
add_filter( 'get_previous_post_sort', 'idiit_adjacent_events_sort', 1, 1 );
add_filter( 'get_next_post_sort', 'idiit_adjacent_events_sort', 1, 1 );

function idiit_adjacent_events_join ($join, $in_same_term, $excluded_terms) {
	if ('event' == get_post_type()) {
		global $wpdb;
		$join = "INNER JOIN $wpdb->postmeta m ON m.post_id = p.ID AND m.meta_key = 'start_date'";
	}
	return $join;
}

function idiit_adjacent_events_where ($where, $in_same_term, $excluded_terms) {
	if ('event' == get_post_type()) {
		$where .= "AND STR_TO_DATE(m.meta_value, '%Y%m%d') >= CURDATE()";
		$pattern = '/p.post_date (>|<) (\'\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}\')/';
		$replacement = sprintf("m.meta_value $1 '%s'", get_field('start_date'));
		$where = preg_replace($pattern, $replacement, $where);
	}
	return $where;
}

function idiit_adjacent_events_sort ($orderby) {
	if ('event' == get_post_type()) {
		$orderby = str_replace('p.post_date', 'm.meta_value', $orderby);
	}
	return $orderby;
}
