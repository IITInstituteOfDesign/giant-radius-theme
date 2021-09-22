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

// Recent posts wrapper.
if ( false !== $data->events && $data->events->have_posts() ) {
	while ( $data->events->have_posts() ): $data->events->the_post();
		$booknow = esc_url( eventbrite_event_eb_url( ( $data->args['tickets'] ) ? '#tickets' : '' ) );
		?>
<div class="widget_Featured_Event_ctm">
	<div class="box">
			<article class="content big_image">	
				<figure>
				<?php
					if ( $data->args['thumb'] ) :
							// Check if post has post thumbnail.
							if ( ! empty( $data->events->post->logo_url ) ) :
								// Thumbnails.
								printf( '<a  href="%1$s" rel="bookmark" %4$s><img class="wp-post-image" src="%2$s" alt="%3$s"></a>',
									$booknow,
									esc_url( $data->events->post->logo_url ),
									esc_attr( get_the_title() ),
									( $data->args['newtab'] ) ? 'target="_blank"' : ''
								);

							// Display default image.
                            elseif ( ! empty( $data->args['thumb_default'] ) ) :
								printf( '<a href="%1$s" rel="bookmark" %4$s><img class="wp-post-image" src="%2$s" alt="%3$s"></a>',
									$booknow,
									esc_url( $data->args['thumb_default'] ),
									esc_attr( get_the_title() ),
									( $data->args['newtab'] ) ? 'target="_blank"' : ''
								);
							endif;
					endif; ?>
			</figure>
			<div class="main-content">
				<h3><a href="<?php echo esc_url( eventbrite_event_eb_url() ); ?>" target="_blank"><?php echo esc_attr( get_the_title() ); ?></a></h3>
				<p><?php 
					if ( $data->args['date'] ) :
						$date = wfea_event_time();
						printf( '%1$s', esc_html( $date ) );
					endif; ?>
				</p>
				<a class="custom-btn" href="<?php echo esc_url( eventbrite_event_eb_url() ); ?>"> REGISTER</a>
			</div>
		</article>
	</div>
</div>
	<?php
	endwhile;

} else {
	?>
    <p class='not-found'><?php _e( 'No Events Found', 'widget-for-eventbrite-api' ); ?></p>
	<?php
}
?>

