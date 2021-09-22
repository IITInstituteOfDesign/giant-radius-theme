<div class="metadata">
	<div class="column">
		<strong>Date:</strong>
		<ul class="list-unstyled">
			<li><?php the_date(); ?></li>
		</ul>
	</div>
	<?php if (have_rows('links')): ?>
		<div class="column">
			<strong>Links</strong>
			<ul class="list-unstyled">
				<?php while (have_rows('links')): the_row(); ?>
					<li><?php printf('<a href="%s">%s</a>', get_sub_field('link'), get_sub_field('link')); ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php foreach (get_public_taxonomies() as $taxonomy): ?>
		<?php $terms = get_the_terms( get_the_ID(), $taxonomy->name ); ?>
		<?php if ($terms): ?>
			<div class="column">
				<strong><?php echo $taxonomy->label; ?></strong>
				<ul class="list-unstyled">
					<?php foreach ($terms as $term): ?>
						<li><?php echo $term->name; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>

	<?php if (get_field('email') || get_field('phone')): ?>
		<div class="column">
			<strong>Contact</strong>
			<ul class="list-unstyled">
				<?php if (get_field('email')): ?>
					<li><?php printf('<a href="mailto:%s">%s</a>', get_field('email'), get_field('email')); ?></li>
				<?php endif; ?>

				<?php if (get_field('phone')): ?>
					<li><?php printf('<a href="tel:%s">%s</a>', get_field('phone'), get_field('phone')); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
