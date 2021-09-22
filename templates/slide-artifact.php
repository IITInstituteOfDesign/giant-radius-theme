<?php if (is_singular('artifact')): ?>
	<section class="image-fill">
		<?php the_artifact( get_the_ID() ); ?>
		<?php if (get_field('url') && !wp_oembed_get( get_field('url') )): ?>
			<div class="action">
				<div class="wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
  <path d="M0 0v8h8v-2h-1v1h-6v-6h1v-1h-2zm4 0l1.5 1.5-2.5 2.5 1 1 2.5-2.5 1.5 1.5v-4h-4z" />
</svg>
					<span>&nbsp;Open Link</span>
				</div>
			</div>
		<?php elseif (get_field('file')): ?>
			<div class="action">
				<div class="wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
  <path d="M4.5 0c-1.21 0-2.27.86-2.5 2-1.1 0-2 .9-2 2 0 .37.11.71.28 1h2.72v-.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v.5h1.91c.06-.16.09-.32.09-.5 0-.65-.42-1.29-1-1.5v-.5c0-1.38-1.12-2.5-2.5-2.5zm-.16 4a.5.5 0 0 0-.34.5v1.5h-1.5l2 2 2-2h-1.5v-1.5a.5.5 0 0 0-.59-.5.5.5 0 0 0-.06 0z"
  />
</svg>
					<span>&nbsp;Download <?php the_artifact_filetype(); ?></span>
				</div>
			</div>
		<?php endif; ?>
	</section>
<?php else: ?>
	<?php get_template_part('templates/slide');?>
<?php endif; ?>
