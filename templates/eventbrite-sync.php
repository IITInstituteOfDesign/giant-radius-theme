<div id="idiit-eventbrite-sync">
	<ul>
		<?php $last_sync = get_option( 'idiit_eventbrite_last_run' ); ?>
		<?php $next_sync = wp_next_scheduled( 'idiit_eventbrite_sync' ); ?>
		<li></li>
		<li><?php printf( 'Last sync with Eventbrite was %s ago.', human_time_diff( $last_sync, time() ) ); ?></li>
		<li>
			<?php printf( 'Will sync again in %s, or', human_time_diff( $next_sync, time() ) ); ?>
			<a href="<?php echo admin_url( 'admin-post.php?action=force_eventbrite_sync' ); ?>">sync now</a>.
		</li>
	</ul>
	<div class="clear"></div>
</div>