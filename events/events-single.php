<?php

$eventq = get_query_var( 'custom_event' );
$event = explode('-', $eventq);
$eventID = end($event);
// $events = new Eventbrite_Query(apply_filters( 'eventbrite_query_args', array(
// 		                    'display_private' => true, // boolean
// 		                    'status' => 'live',         // string (only available for display_private true)
// 		                    'limit' => 1,            // integer
// 		                ) ) );
// if ( $events->have_posts() ) :
// 	while ( $events->have_posts() ) : $events->the_post();
?>
<?php
$api_request = eventbrite_get_event($eventID, true);

$organizerID = $api_request->events[0]->organizer->id;
$url = $api_request->events[0]->url;

$original_img = $api_request->events[0]->logo->original->url;
$title = $api_request->events[0]->post_title;
$content = $api_request->events[0]->post_content;
$address = $api_request->events[0]->venue->address->localized_address_display;

$start = $api_request->events[0]->start->local;
$end = $api_request->events[0]->end->local;

$free = $api_request->events[0]->tickets->free;

if (new DateTime() > new DateTime($start)) {
	$ended = true;
}else{
	$ended = false;
}

if ($title != ''): ?>

<div class="template_side_sticky template_events">
	<main class="single_post__main single_main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<h1 class="single_header__title"><?php echo $title; ?></h1>
					<figure class="single_header__featured">
						<img src="<?php echo $original_img ?>" alt="<?php echo $title; ?>">
					</figure>
					<article class="single_post__article single_article" >
						<div class="single_article__style">
							<?php echo $content; ?>
						</div>
					</article>
				</div>
				<div class="col-lg-4">
					<aside>
						<div class="sticky-box">
							<?php if($ended == false): ?>
								<?php if (null !== eb_event_time($start, $end)): ?>
									<h4 class="title">Date and Time</h4>
									<?php echo eb_event_time($start, $end) ?>
									<hr>
								<?php endif; ?>
								<?php if (isset($address)): ?>
									<h4 class="title">Location</h4>
									<p><?php echo $address; ?></p>
									<hr>
								<?php endif; ?>
								<a class="custom-btn" href="<?php echo $url ?>" target="_blank"><?php echo $free == true ? 'REGISTER' : 'TICKETS' ?></a>
							<?php else: ?>
								<h4 class="event-ended">This event has ended</h4>
							<?php endif; ?>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</main>
</div>

<?php
	// endwhile;
else:
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );
endif;
// wp_reset_postdata();
?>