
<?php $date = get_date(); ?>
<nav class="calendar">
<!--
		<a class="prev-month" href="<?php the_nav_link( get_prev_month($date) ); ?>">
			<?php echo get_prev_month($date)->format('F Y'); ?>
		</a>
-->
</nav>

<h1 class="text-center">
	<span id="current_month" data-date="<?php echo $date->format('m/d/Y'); ?>">
		<?php echo $date->format('F Y'); ?>
		<span class="caret"></span>
	</span>
</h1>

<div id="calendar">
	<table>
		<thead>
			<tr>
				<th>Sunday</th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
				<th>Saturday</th>
			</tr>
		</thead>

		<tbody>
			<?php $start = $date->copy()->startOfMonth(); ?>
			<?php $start->modify('-'. $start->format('w') . 'days'); ?>
			<?php for ($n = 0; $n < 42; $n++): ?>
				<?php $posts = get_events( $start ); ?>

				<?php if ($n % 7 == 0) { echo '<tr>'; } ?>
				<td class="<?php echo calendar_day_classes($start, $date, $posts); ?>">
					<ol class="content">
						<li><?php echo $start->day; ?></li>

						<?php if ($start->isToday() && empty($posts)): ?>
							<li>No events today.</li>
						<?php endif; ?>

						<?php foreach ($posts as $post): ?>
							<?php setup_postdata( $post ); ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php if (get_field('venue_name')): ?>
								<br><span class="venue">
									<?php the_field('venue_name'); ?>
								</span>
							<?php endif;?>

							<?php if (get_field('start_time') && get_field('end_time')): ?>
								<br><span class="time">
									<?php printf('%s &ndash; %s', get_field('start_time'), get_field('end_time')); ?>
								</span>
							<?php endif; ?>
						<?php endforeach; ?>
					</ol>
				</td>
				<?php if ($n % 7 == 7) { echo '</tr>'; } ?>
				<?php $start->modify('+1 days'); ?>
			<?php endfor; ?>
		</tbody>
	</table>
</div>

<nav class="calendar">
<!--
	<a class="next-month" href="<?php the_nav_link( get_next_month($date) ); ?>">
		<?php echo get_next_month($date)->format('F Y'); ?>
	</a>
-->
</nav>
