
<section class="collection-grid">
<?php 

// args
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'profile',
	'meta_key'		=> 'year',
	'meta_value'	=> '2016'
);






// query
$the_query = new WP_Query( $args );

?>
<?php if( $the_query->have_posts() ): ?>
	<ul>
	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
				<?php the_title(); ?>
			</a>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

</section>











