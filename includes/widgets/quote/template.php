<?php echo $before_widget; ?>

<?php if ($query->have_posts()): ?>
	<?php while ($query->have_posts()): $query->the_post(); ?>
		<?php $person = get_post( get_field('quote_author') ); ?>
		<?php if (!empty($person)): ?>
			<a href="<?php echo get_permalink($person); ?>">
				<span class="text-muted">
		      <?php echo role( $person ); ?> Quote
		    </span>

				<blockquote class="ellipsis"><?php the_field('quote_body'); ?></blockquote>
				<div class="citation">
					<strong><?php echo get_the_title( $person ); ?></strong>
				</div>
				<div class="quote-bg" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id( $person->ID ), 'tile' ); ?>)"></div>
			</a>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>

<?php echo $after_widget; ?>
