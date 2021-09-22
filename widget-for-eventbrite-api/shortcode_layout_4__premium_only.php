<?php
/**
 * Front end display of shortcode loop
 * can be overridden in child themes / themes or in wp-content/widget-for-eventbrite-api folder if you don't have a child theme and you don't want to lose changes due to themes updates
 *
 * To customise create a folder in your theme directory called widget-for-eventbrite-api and a modified version of this file called shortcode_layout_1__premium_only.php
 * If you need a second layout  create a file e.g. shortcode_layout_2__premium_only.php  and call with [wfea layout=2]
 *
 * @var mixed $data Custom data for the template.
 */

$popup = '';
if ( $data->args['popup'] ) {
	wp_enqueue_script( $data->plugin_name . '-featherlight-js' );
	wp_enqueue_script( $data->plugin_name . '-popup-js' );
	wp_enqueue_style( $data->plugin_name . '-featherlight-css' );
	$popup = 'wfea-popup';
}
// Recent posts wrapper.
printf( '<section %1$s class="wfea %2$s %3$s grid">',
	( ! empty( $data->args['cssID'] ) ? 'id="' . sanitize_html_class( $data->args['cssID'] ) . '"' : '' ),
	( ! empty( $data->args['css_class'] ) ? '' . sanitize_html_class( $data->args['css_class'] ) . '' : '' ),
	( ! empty( $data->template ) ? '' . sanitize_html_class( $data->template ) . '' : '' )
);

if ( false !== $data->events && $data->events->have_posts() ) {
	while ( $data->events->have_posts() ): $data->events->the_post();
		$booknow = esc_url( eventbrite_event_eb_url( ( $data->args['tickets'] ) ? '#tickets' : '' ) );
		$popupheight = '';
		if ( $data->args['popup'] ) {
			$popupheight = 'data-featherlight-iframe-height="' . wfea_get_ticket_form_widget_height() . '"';
			$booknow     = esc_url( 'https://www.eventbrite.co.uk/tickets-external?eid=' . $data->events->post->ID );
		}
		?>
        <article class="post">
            <div class="wfea-group">
                <div class="wfea-banner">
					<?php
					if ( $data->args['thumb'] ) :
						?>
                        <figure class="<?php echo $popup; ?>">
							<?php

							// Check if post has post thumbnail.
							if ( ! empty( $data->events->post->logo_url ) ) :
								// Thumbnails.
								printf( '<a %5$s href="%1$s" rel="bookmark" %4$s><img class="wp-post-image" src="%2$s" alt="%3$s"></a>',
									$booknow,
									esc_url( $data->events->post->logo_url ),
									esc_attr( get_the_title() ),
									( $data->args['newtab'] ) ? 'target="_blank"' : '',
									$popupheight
								);

							// Display default image.
                            elseif ( ! empty( $data->args['thumb_default'] ) ) :
								printf( '<a %5$s href="%1$s" rel="bookmark" %4$s><img class="wp-post-image" src="%2$s" alt="%3$s"></a>',
									$booknow,
									esc_url( $data->args['thumb_default'] ),
									esc_attr( get_the_title() ),
									( $data->args['newtab'] ) ? 'target="_blank"' : '',
									$popupheight
								);
							endif;
							?>
                        </figure>
					<?php
					endif;
					?>
                    <header class="entry-header">
                        <h4 class="entry-title <?php echo $popup; ?>">
							<?php
							printf( '<a %5$s href="%1$s" title="%2$s" rel="bookmark" %4$s>%3$s</a>',
								$booknow,
								sprintf( esc_attr__( 'Eventbrite link to %1$s', 'widget-for-eventbrite-api' ), the_title_attribute( 'echo=0' ) ),
								the_title_attribute( 'echo=0' ),
								( $data->args['newtab'] ) ? 'target="_blank"' : '',
								$popupheight
							);
							?>
                        </h4>

                    </header>
                </div>


                <div class="entry-meta">
					<?php
					if ( $data->args['date'] ) :
						$date = wfea_event_time();
						printf( '<time class="eaw-time published" datetime="%1$s">%2$s</time>', esc_html( get_the_date( 'c' ) ), esc_html( $date ) );
					endif;
					?>
                </div>
                <div class="entry-content">
					<?php
					if ( $data->args['excerpt'] ) :
						?>
                        <div class="excerpt">
							<?php
							if ( $data->args['content'] ) {
								the_content();
							} else {
								echo wp_trim_words( apply_filters( 'eawp_excerpt', get_the_excerpt() ), $data->args['length'], ' &hellip;' );
								if ( $data->args['readmore'] ) {
									printf( '<a href="%1$s" class="more-link" %3$s aria-label="%4$s">%2$s</a>',
										esc_url( eventbrite_event_eb_url() ),
										$data->args['readmore_text'],
										( $data->args['newtab'] ) ? 'target="_blank"' : '',
										( empty( $data->args['aria_label_readmore'] ) ) ? $data->args['booknow_text'] . ' ' . __( 'on Eventbrite for', 'widget-for-eventbrite-api' ) . ' ' . esc_attr( get_the_title() ) : $data->args['aria_label_readmore']
									);
								}
							}
							?>
                        </div>
					<?php
					endif;
					?>
                </div>
            </div>
			<?php
			if ( $data->args['booknow'] ) :
				?>
                <div class="booknow <?php echo $popup; ?>"> <?php
					printf( '<a %5$s href="%1$s" %3$s aria-label="%4$s"><button>%2$s</button></a>',
						$booknow,
						$data->args['booknow_text'],
						( $data->args['newtab'] ) ? 'target="_blank"' : '',
						( empty( $data->args['aria_label_booknow'] ) ) ? $data->args['booknow_text'] . ' ' . __( 'on Eventbrite for', 'widget-for-eventbrite-api' ) . ' ' . esc_attr( get_the_title() ) : $data->args['aria_label_booknow'],
						$popupheight
					);
					?>
                </div>
			<?php
			endif;
			?>
        </article>
	<?php
	endwhile;

} else {
	?>
    <p class='not-found'><?php _e( 'No Events Found', 'widget-for-eventbrite-api' ); ?></p>
	<?php
}
?>
</section><!-- Generated by http://wordpress.org/plugins/widget-for-eventbrite-api/ -->
