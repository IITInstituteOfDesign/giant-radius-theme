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
printf( '<div class="box widget_feed_box_events" style="position:relative">',
	( ! empty( $data->args['cssID'] ) ? 'id="' . sanitize_html_class( $data->args['cssID'] ) . '"' : '' ),
	( ! empty( $data->args['css_class'] ) ? '' . sanitize_html_class( $data->args['css_class'] ) . '' : '' )
);

if ( false !== $data->events && $data->events->have_posts() ) {
        $x=0;
	while ( $data->events->have_posts() ): $data->events->the_post();
		$booknow = esc_url( eventbrite_event_eb_url( ( $data->args['tickets'] ) ? '#tickets' : '' ) );
		$popupheight = '';
		if ( $data->args['popup'] ) {
			$popupheight = 'data-featherlight-iframe-height="' . wfea_get_ticket_form_widget_height() . '"';
			$booknow     = esc_url( 'https://www.eventbrite.co.uk/tickets-external?eid=' . $data->events->post->ID );
		}
		?>
	<a class="article-container <?php if($x==0){echo 'incoming';} ?>" href="<?php echo esc_url( eventbrite_event_eb_url() ); ?>" target="_blank">
         <article>
			<div class="right">
                         <?php if($x==0){ echo '<h5>UPCOMING EVENT</h5>';} ?>
			<h3><?php echo esc_attr( get_the_title() ); ?></h3>
             <div class="date"><?php
                                                        if ( $data->args['date'] ) :
                                                                $date = wfea_event_time();
                                                                echo esc_html( $date );
                                                        endif;
                                                        ?></div>
         </div>
        </article>
      </a>
<?php
	$x++;							
	endwhile;
} else {
	?>
    <p class='not-found'><?php _e( 'No Events Found', 'widget-for-eventbrite-api' ); ?></p>
	<?php
}
?>
<div class="bottom-btn">
        <a href="/events/" class="custom-btn">
            ALL EVENTS        </a>
    </div>
</div><!-- Generated by http://wordpress.org/plugins/widget-for-eventbrite-api/ -->
