<?php if ($post_type_name == 'profile'): ?>
	<div class="col-xl-3 col-lg-4 col-sm-6">
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
			<?php if (get_post_meta($post->ID, 'focus', true)):?>
				<div class="employ">
					<p><?php echo get_post_meta($post->ID, 'focus', true); ?></p>
				</div>
			<?php endif; ?>
		</article>
	</div>
<?php elseif($post_type_name == 'student'): ?>
    student output
<?php else:

	$post_type_obj = get_post_type_object(get_post_type());

    ?>
	<div class="col-xl-3 col-lg-4 col-sm-6">
		<a href="<?php the_permalink(); ?>" class="archive_item">
			<figure><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'card') ?>" alt=""></figure>
			<h3><?php the_title(); ?></h3>
            <?php

            if ($post_type_obj->name == 'project'):
                $tags = get_the_terms($post->ID,'project_type');
                $output = '';
                $separator = ' | ';
                if ($tags) {
                    foreach ($tags as $tag) {
                        $output .= '<a class="taglink" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
                    }
                    echo trim($output, $separator);
                }
            endif;
			?>
		</a>
	</div>
<?php endif; ?>
