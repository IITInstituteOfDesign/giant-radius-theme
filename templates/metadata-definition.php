<div class="metadata">
	<?php if (get_field('submitted_by')): ?>
		<div class="column">
			<strong>Submitted to ID by:</strong>
			<ul class="list-unstyled">
				<li><?php the_field('submitted_by'); ?></li>
				<li><?php the_date(); ?></li>
			</ul>
		</div>
	<?php endif; ?>
</div>
