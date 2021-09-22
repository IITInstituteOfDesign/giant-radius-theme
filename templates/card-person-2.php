<article class="person_item">
	<figure class="person_item__image">
		<a href="<?php the_permalink(); ?>">
			<?php if (has_post_thumbnail()) {
				the_post_thumbnail('card');
			}else{
				echo "<img src='".get_template_directory_uri()."/assets/img/no-image-person.jpg'>";
			}
			?>
		</a>
	</figure>
	<a class="title" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
	<?php if (have_rows('employment')):?>
		<div class="employ">
			<?php while(have_rows('employment')): the_row(); ?>
				<?php echo "<p> " ?>
				<?php $output = array( get_sub_field('position') ); ?>
				<?php $output[] = get_sub_field('organization'); ?>
				<?php $output = implode('<br>', array_filter( $output )); ?>
				<?php echo $output; ?>
				<?php echo "</p>" ?>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</article>