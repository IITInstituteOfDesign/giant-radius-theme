<?php
if (get_field('project_artifacts')): ?>

	<?php if (get_field('style') == null || get_field('style') == 'Default') : ?>

		<?php if (count(get_field('project_artifacts')) <= 5): ?>
			<?php get_template_part('templates/artifacts/artifacts-slider', 'project_artifacts') ?>
		<?php else: ?>
			<?php get_template_part('templates/artifacts/artifacts-list', 'project_artifacts') ?>
		<?php endif; ?>

	<?php elseif (get_field('style') == 'Slider'): ?>

			<?php get_template_part('templates/artifacts/artifacts-slider', 'project_artifacts') ?>

	<?php elseif(get_field('style') == 'List'): ?>

			<?php get_template_part('templates/artifacts/artifacts-list', 'project_artifacts') ?>

	<?php endif; ?>

<?php endif; ?>