<article class="person_item">
	<figure class="person_item__image">
		<a href="<?php the_field('linkedin_profile'); ?>">
			<?php if (has_post_thumbnail()) {
				the_post_thumbnail('card');
			}else{
				echo "<img src='".get_template_directory_uri()."/assets/img/no-image-person.jpg'>";
			}
			?>
		</a>
	</figure>
	<a class="title" href="<?php the_field('linkedin_profile'); ?>">
        <h3><?php the_title(); ?></h3>
    </a>

    <div class="employ">
        <?php echo "<p> " ?>
        <?php $output = array( get_field('class_year') ); ?>
        <?php $output[] = get_field('degree_program'); ?>
        <?php $output = implode('<br>', array_filter( $output )); ?>
        <?php echo $output; ?>
        <?php echo "</p>" ?>
    </div>

</article>
