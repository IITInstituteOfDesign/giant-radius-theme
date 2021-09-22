<?php

require_once get_template_directory() . '/vendor/carbon/Carbon.php';
use Carbon\Carbon;

/**
 * Get currently viewed date.
 *
 * Create Carbon date based on query string params. Defaults to current date.
 *
 * @return object Carbon date.
 */
function get_date() {
	$date = Carbon::parse( date_i18n('c') );
	$date = $date->startOfMonth();

	if (!empty(get_query_var('year'))) {
		$date->year = get_query_var('year');
	}

	if (!empty(get_query_var('monthnum'))) {
		$date->month = get_query_var('monthnum');
	}

	if (!empty(get_query_var('day'))) {
		$date->day = get_query_var('day');
	}

	return $date;
}

/**
 * Returns the previous month.
 *
 * Given the current calendar month, return the previous calendar month.
 *
 * @param  object $date Carbon date.
 * @return object       Modified date.
 */
function get_prev_month ($date) {
	return $date->copy()->subMonthNoOverflow();
}

/**
 * Returns the next month.
 *
 * Given the current calendar month, return the next calendar month.
 *
 * @param  object $date Carbon date.
 * @return object       Modified date.
 */
function get_next_month ($date) {
	return $date->copy()->addMonthNoOverflow();
}

/**
 * Print nav link.
 *
 * Prints the URL of an adjacent month.
 *
 * @param  object $date Next or previous Carbon instance.
 * @return string       URL of adjacent date archive.
 */
function the_nav_link($date) {
	$url = get_post_type_archive_link( 'event' );
	$url .= "/{$date->year}/{$date->month}";
	echo str_replace(array( '%5B', '%5D'), array( '[', ']' ), $url);
}

/**
 * Get array of events.
 *
 * Retrieves an array of events in the current calendar month.
 *
 * @param  object $date Current month Carbon instance.
 * @param  array  $args Any overriding arguments to pass to get_posts().
 * @return array        List of event post objects.
 */
function get_events($date, $args = array()) {
	$args = filtered_query(array(
		'post_type'  => 'event',
		'order'      => 'desc',
		'meta_key'   => 'start_date',
		'orderby'    => 'meta_value_num',
		'nopaging'   => true,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'start_date',
				'value' => $date->format('Ymd'),
				'type' => 'DATE',
				'compare' => '<='
			),
			array(
				'key' => 'end_date',
				'value' => $date->format('Ymd'),
				'type' => 'DATE',
				'compare' => '>='
			)
		)
	));

	return get_posts( $args );
}

/**
 * HTML class list for an calendar day.
 *
 * Returns a list of HTML classes for a day on the calendar.
 *
 * @param  object $current Carbon instance of the current calendar day.
 * @param  object $date    Carbon instance for the current month view.
 * @param  array  $posts   List of event post objects for calendar month.
 * @return string          HTML class list.
 */
function calendar_day_classes ($current, $date, $posts) {
	$classes = array();
	$current = $current->startOfDay();
	$date = $date->startOfDay();
	$today = Carbon::parse( date_i18n('c') )->startOfDay();

	if ($current < $today) {
		$classes[] = 'past';
	} else if ($current > $today) {
		$classes[] = 'upcoming';
	} else {
		$classes[] = 'today';
	}

	if ($current->month < $date->month) {
		$classes[] = 'month-prev';
	} else if ($current->month > $date->month) {
		$classes[] = 'month-next';
	} else {
		$classes[] = 'month-current';
	}

	if (count($posts) > 0) {
		$classes[] = 'has-events';
	}

	return implode(' ', $classes);
}

/**
 * Get long formatted date.
 *
 * Gets the date and formats it as a long string.
 *
 * @return string Long format date string.
 */
function get_long_date() {
	if (get_field('start_date')) {
		$start_date = new Carbon(get_field('start_date'));

		if (get_field('end_date')) {
			$end_date = new Carbon(get_field('end_date'));
			if ($start_date->isSameDay($end_date)) {
				return $start_date->format('l, F j, Y');
			} elseif ($start_date->month === $end_date->month) {
				return sprintf('%s &ndash; %s', $start_date->format('F j'), $end_date->format('j, Y'));
			} elseif ($start_date->year === $end_date->year) {
				return sprintf('%s &ndash; %s', $start_date->format('F j'), $end_date->format('F j, Y'));
			} else {
				sprintf('%s &ndash; %s', $start_date->format('F j, Y'), $end_date->format('F j, Y'));
			}
		} else {
			return $start_date->format('l, F j, Y');
		}
	}
}

/**
 * Print long formatted date.
 *
 * Prints the date formatted as a long string.
 *
 * @see get_long_date()
 * @return null
 */
function the_long_date() {
	echo get_long_date();
}

/**
 * Get short date.
 *
 * Formats a date in ISO year format.
 *
 * @param  string $field Optional. ACF field to retrieve. Defaults to end_date.
 * @return string        Formatted date string.
 */
function get_short_date($field = 'end_date') {
	$date = new Carbon(get_field($field));
	return $date->format('Y-m-d');
}

/**
 * Print short date.
 *
 * Prints a date in ISO year format.
 *
 * @param  string $field Optional. ACF field to retrieve. Defaults to end_date.
 * @return null
 */
function the_short_date($field = 'start_date') {
	echo get_short_date();
}







function the_event_address() {
	$address = get_field('location')["address"];
	$address = explode( ', ', $address );
	if (count($address) > 2) {
		$address[1] = "{$address[1]}, {$address[2]}";
		unset($address[2]);
	}
	echo implode('<br>', $address);
}
