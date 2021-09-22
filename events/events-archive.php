<?php while (have_posts()): the_post(); ?>

	<header class="events_header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="events_header__title"><?php the_title(); ?></h1>
					<?php get_template_part('templates/hero-unit') ?>
				</div>
			</div>
		</div>
	</header>
	<main class="events-container">
		<div class="container">
			<div class="row">
				<?php
                // Set up and call our Eventbrite query.
				$events = new Eventbrite_Query( apply_filters( 'eventbrite_query_args', array(
                    'display_private' => true, // boolean
                    'status' => 'live',         // string (only available for display_private true)
                    'nopaging' => true,        // boolean
                     // 'limit' => -1,            // integer
                    'organizer_id' => 2741168798,     // integer
                    // 'p' => null,                // integer
                    // 'post__not_in' => null,     // array of integers
                    // 'venue_id' => null,         // integer
                    // 'category_id' => null,      // integer
                    // 'subcategory_id' => null,   // integer
                    // 'format_id' => null,        // integer
                ) ) );
				if ( $events->have_posts() ) :
					while ( $events->have_posts() ) : $events->the_post(); ?>
						<div class="col-lg-4 col-md-6 event-column">
							<article class="event-item">
								<div class="event-item--image">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="event-item--content">
									<a href="<?php echo eb_event_url() ?>"><h3><?php the_title(); ?></h3></a>
									<div class="date"><?php echo eventbrite_event_time();?></div>
								</div>
							</article>
						</div>
						<?php
					endwhile;
					echo "</div><div class='row'>";
					//eventbrite_paging_nav( $events );
				endif;
				wp_reset_postdata();
				?>


			</div>
		</div>
	</main>


	<?php endwhile; ?>
