<div class="metadata">
	<?php if (have_rows('employment')): ?>
		<div class="column">
			<h3>Titles</h3>
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

    <?php if(get_the_ID() == 2097): ?>

	    <?php if (get_field('email') || get_field('phone')): ?>
            <div class="column">
                <h3>Contact</h3>
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


        <?php if (get_field('staff_area_of_interest')): ?>
            <div class="column">
                <p>
				    <?php the_field('staff_area_of_interest'); ?>
                </p>
            </div>
	    <?php endif; ?>
    <?php endif; ?>

	<?php if (have_rows('degrees')): ?>
		<div class="column">
			<h3>Degrees</h3>
			<ul class="list-unstyled">
				<?php while(have_rows('degrees')): the_row(); ?>
					<?php $output = array( get_sub_field('program'), get_sub_field('year') ); ?>
					<?php $output = implode(', ', array_filter( $output )); ?>
					<li><strong><?php echo get_sub_field('institution_name')."</strong><br>".$output; ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if (get_field('areas_of_interest')): ?>
        <div class="column">
            <h3>Areas of Interest</h3>
            <p>
                <?php the_field('areas_of_interest'); ?>
            </p>
        </div>
	<?php endif; ?>

	<?php $post_objects = get_field('related_courses');
	if( $post_objects ): ?>
        <div class="column">
            <h3>Related Courses</h3>
            <ul style="margin-left:0; padding-left:0;">
				<?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>
                    <li style="list-style: none;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
			<?php wp_reset_postdata();
			// IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
	<?php endif; ?>

	<?php

	/*
	*  Query posts for a relationship value.
	*  This method uses the meta_query LIKE to match the string "123"
	 * to the database value a:1:{i:0;s:3:"123";} (serialized array)
	*/

	$articles = get_posts(array(
		'post_type' => array('post','project'),
		'meta_query' => array(
			array(
				'key' => 'this_article_mentions', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE',
			)
		),
		'posts_per_page' => -1,
	));



	?>
	<?php if( $articles ): ?>
        <div class="column">
            <h3>Related Articles</h3>
            <ul style="margin-left:0; padding-left:0;">
                <?php foreach( $articles as $article ): ?>
                    <li style="list-style: none;">
                        <a href="<?php echo get_permalink( $article->ID ); ?>">
                            <?php echo get_the_title( $article->ID ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
	<?php endif; ?>

	<?php if (get_field('cv')): ?>
        <div class="column">
            <h3>CV</h3>
            <p>
				<a href="<?php the_field('cv'); ?>" class="btn">To Download Click Here</a>
            </p>
        </div>
	<?php endif; ?>

	<?php if (have_rows('links')): ?>
        <div class="column">
            <h3>Profiles</h3>
            <ul class="list-unstyled">
				<?php while (have_rows('links')): the_row(); ?>
                    <li><?php printf('<a href="%s">%s</a>', get_sub_field('link'), get_sub_field('link')); ?></li>
				<?php endwhile; ?>
            </ul>
        </div>
	<?php endif; ?>



	<?php foreach (get_public_taxonomies() as $taxonomy): ?>
		<?php $terms = get_the_terms( get_the_ID(), $taxonomy->name ); ?>
		<?php if ($terms && $taxonomy->label != 'Tags' && $taxonomy->label != 'Roles'): ?>
			<div class="column">
				<h3><?php echo $taxonomy->label; ?></h3>
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

	<?php if(get_the_ID() != 2097): ?>
        <?php if (get_field('email') || get_field('phone')): ?>
            <div class="column">
                <h3>Contact</h3>
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
	<?php endif; ?>

	<?php if(get_the_ID() != 2097): ?>
        <?php if (get_field('staff_area_of_interest')): ?>
            <div class="column">
            <p>
                <?php the_field('staff_area_of_interest'); ?>
            </p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
