<div class="metadata">
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

	<?php if (have_rows('employment')): ?>
		<div class="column">
			<strong>Positions</strong>
			<ul class="list-unstyled">
				<?php while(have_rows('employment')): the_row(); ?>
					<?php $output = array( get_sub_field('position') ); ?>
					<?php if (get_sub_field('organization') !== 'IIT Institute of Design'): ?>
						<?php $output[] = get_sub_field('organization'); ?>
					<?php endif; ?>
					<?php $output = implode(', ', array_filter( $output )); ?>
					<li><?php echo $output; ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if (have_rows('degrees')): ?>
		<div class="column">
			<strong>Degrees</strong>
			<ul class="list-unstyled">
				<?php while(have_rows('degrees')): the_row(); ?>
					<?php $output = array( get_sub_field('program'), get_sub_field('year') ); ?>
					<?php $output = implode(', ', array_filter( $output )); ?>
					<li><?php echo $output; ?></li>
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
						<li>
							<?php $output = array(); ?>
							<?php if ($term->name === 'Faculty' && get_field('designation')): ?>
								<?php $output[] = ucwords( get_field('designation') ); ?>
							<?php endif; ?>
							<?php $output[] = $term->name; ?>
							<?php echo implode(' ', $output); ?>
						</li>
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
