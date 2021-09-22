<section class="collection-grid">

<?php 

// get posts
$posts = get_posts(array(
	'post_type'			=> 'profile',
	'posts_per_page'	=> -1,
	'meta_key'			=> 'background',
	'orderby'			=> 'meta_value',
	'order'				=> 'DESC'
));

if( $posts ): ?>
	
    <div class="cards">
		
	<?php foreach( $posts as $post ): 
		
		setup_postdata( $post )
		
	?>
        <?php get_template_part('templates/card', get_query_var('post_type')); ?>

	
	<?php endforeach; ?>
	
    </div>
	
	<?php wp_reset_postdata(); ?>

<?php endif; ?>
</section>



      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/card', get_query_var('post_type')); ?>
      <?php endwhile; ?>




