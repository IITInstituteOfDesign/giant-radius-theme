<div class="col-md-3">
	<a class="card-artifact" href="<?php the_permalink(); ?>">
		<?php the_image( true ); ?>
		<h3><?php the_title(); ?></h3><br>
		<?php while(have_rows('employment')): the_row(); ?>
			<?php echo "<span style='font-size:10pt'" ?>
			<?php $output = array( get_sub_field('position') ); ?>
			<?php echo "<br>" ?>
			<?php $output[] = get_sub_field('organization'); ?>
			<?php $output = implode('<br>', array_filter( $output )); ?>
			<?php echo $output; ?>
			<?php echo "</span>" ?>
			<?php echo "<div style='margin-top:10px'>" ?>
			<?php echo "</div>" ?>
		<?php endwhile; ?>
	</a>
</div>