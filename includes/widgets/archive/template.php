<?php echo $before_widget; ?>

<?php if ($instance['archive_filter'] == 'faculty'):
/*
** Display Faculty People
*/
?>

<?php $terms = array('full-time', 'adjunct', 'emeritus'); ?>
<?php foreach ($terms as $term): ?>
	<div class="container p-0">
		<div class="row">
			<div class="col-12"> 
				<a class="btn-title" data-toggle="collapse" href="#collapse-<?php echo $term; ?>" role="button" aria-expanded="true" aria-controls="collapse-<?php echo $term; ?>"><?php printf( '%s Faculty', ucwords($term)); ?><i class="fas fa-angle-down"></i></a>
			</div>
		</div>
	</div>
	<div class="collapse show" id="collapse-<?php echo $term; ?>">
		<div class="collapse-container">
			<div class="container p-0">
				<div class="row">

					<?php
					// global $wp_query;
	
					  if($term == 'adjunct') {
					  $args = filtered_query( array(
						'post_type' => array('person'),
						'posts_per_page' => -1,
						'nopaging'  => true,
						'meta_key'  => 'last_name',
						'order' => 'ASC',
						'orderby'   => 'meta_value',
						'meta_query' => array(
							array(
								'key' => 'designation',
								'value' => $term
							)
						),
					       // 'tax_query' => array(
   	                                       //   array(
		                               //     'taxonomy' => 'person_role',
		                               //     'field'    => 'term_id',
		                               //     'terms'    => array( 133 ),
		                                //    'operator' => 'NOT IN',
	                                        // ),
                                               //),
					));
					} else {
                                            $args = filtered_query( array(
                                                'post_type' => array('person'),
                                                'posts_per_page' => -1,
                                                'nopaging'  => true,
                                                'meta_key'  => 'last_name',
                                                'order' => 'ASC',
                                                'orderby'   => 'meta_value',
                                                'meta_query' => array(
                                                        array(
                                                                'key' => 'designation',
                                                                'value' => $term
                                                        )
                                                ),
                                                'tax_query' => array(
                                                  array(
                                                    'taxonomy' => 'person_role',
                                                    'field'    => 'term_id',
                                                    'terms'    => array( 133 ),
                                                    'operator' => 'NOT IN',
                                                 ),
                                               ),
                                          ));

					}
					$query = new WP_Query( $args );
					if ( $query->have_posts() ):
						while ( $query->have_posts() ):
							$query->the_post();
							?>
							<div class="col-xl-3 col-lg-4 col-sm-6">
								<?php echo get_template_part('templates/card-person-2'); ?>
							</div>
							<?php
						endwhile;
					endif;
					wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<?php elseif($instance['archive_filter'] == 'students'):
/*
** Display students posts
*/
?>

<div class="container p-0">
	<div class="row loadmore">
		<?php
		global $wp_query;
		$args = filtered_query( array(
			'post_type' => array('person'),
			'posts_per_page' => -1, //commented
			'meta_key'  => 'last_name',
			'order' => 'ASC',
			'orderby'   => 'meta_value',
			'tax_query' => array(
				array(
					'taxonomy' => 'person_role',
					'field' => 'slug',
					'terms' => 'students',
					'operator' => 'IN',
				),
			),
		));
		$query = new WP_Query( $args );
		custom_my_load_more_scripts($query->query_vars, $query->max_num_pages, $query->current_page, 'card-person-2');
		if ( $query->have_posts() ):
			while ( $query->have_posts() ):
				$query->the_post();
				?>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<?php echo get_template_part('templates/card-person-2'); ?>
				</div>
				<?php
			endwhile;
			// echo '</div>';
			if ($query->max_num_pages > 1) {
				echo '<div class="row"><div class="col-12 text-center"><div class="custom_loadmore custom-btn">LOAD MORE</div></div></div>';
			}
		endif;
		wp_reset_postdata(); ?>

	</div>
</div>
<?php elseif($instance['archive_filter'] == 'profile'):
/*
** Display profile post type
*/
?>
<div class="container p-0 profile">
	<div class="row">
		<?php
	// global $wp_query;
		$separed = array();
		$args = filtered_query( array(
			'post_type' => array('profile'),
			'posts_per_page' => -1,
			'nopaging'  => true,
			'order' => 'ASC',
			'orderby'   => 'title',
		));

		$query = new WP_Query( $args );
		if ( $query->have_posts() ):
			while ( $query->have_posts() ):
				$query->the_post();
				$separed[get_post_meta(get_the_ID(), 'degree', true)][] = array(get_the_title(), get_the_post_thumbnail(get_the_ID(), 'card'), get_the_permalink(), get_post_meta(get_the_ID(), 'focus', true));
			endwhile;
		endif;
		wp_reset_postdata();
		?>
		<?php foreach ($separed as $key => $value) {
			echo "<div class='col-12'><h2>".$key."</h2></div>";
			foreach ($separed[$key] as $k => $v):
				?>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<article class="person_item">
						<figure class="person_item__image">
							<a href="<?php the_permalink(); ?>">
								<?php if ($v[1]) {
									echo $v[1];
								}else{
									echo "<img src='".get_template_directory_uri()."/assets/img/no-image-person.jpg'>";
								}
								?>
							</a>
						</figure>
						<a class="title" href="<?php echo $v[2] ?>"><h3><?php echo $v[0]; ?></h3></a>
						<div class="employ">
							<p><?php echo $v[3]; ?></p>
						</div>
					</article>
				</div>
				<?php
			endforeach;
		} ?>
	</div>
</div>
<?php elseif($instance['archive_filter'] == 'board-of-advisors'):
	/*
	** Display board of advisors
	*/
	
	$terms = array('','emeritus');
	foreach ($terms as $term): ?>
	<div class="container p-0">
		<div class="row">
			<div class="col-12">
				<a class="btn-title" data-toggle="collapse" href="#collapse-<?php echo $term; ?>" role="button" aria-expanded="true" aria-controls="collapse-<?php echo $term; ?>"><?php printf( '%s Board of Advisors', ucwords($term)); ?><i class="fas fa-angle-down"></i></a>
			</div>
		</div>
	</div>
	<div class="collapse show" id="collapse-<?php echo $term; ?>">
		<div class="collapse-container">
			<div class="container p-0">
				<div class="row">
                                  <?php
					// global $wp_query;

					if ($term =='') {
						$args = filtered_query( array(
							'post_type' => array('person'),
							'posts_per_page' => -1,
							'meta_key'  => 'last_name',
							'order' => 'ASC',
							'orderby'   => 'meta_value',
							'tax_query' => array(
								array(
									'taxonomy' => 'person_role',
									'field' => 'slug',
									'terms' => array($instance['archive_filter']),
									'operator' => 'IN',
								),
							),
							'meta_query'     => [
								[
									'key'   => 'designation',
									'value' => 'emeritus',
									'compare' => 'NOT IN'
								]
							],
						));
					} else {

						$args = filtered_query( [
							'post_type'      => [ 'person' ],
							'posts_per_page' => - 1,
							'nopaging'       => TRUE,
							'meta_key'       => 'last_name',
							'order'          => 'ASC',
							'orderby'        => 'meta_value',
							'tax_query' => array(
								array(
									'taxonomy' => 'person_role',
									'field' => 'slug',
									'terms' => array($instance['archive_filter']),
									'operator' => 'IN',
								),
							),
							'meta_query'     => [
								[
									'key'   => 'designation',
									'value' => $term
								]
							],
						] );
					}
					$query = new WP_Query( $args );
					if ( $query->have_posts() ):
						while ( $query->have_posts() ):
							$query->the_post();
							?>
							<div class="col-xl-3 col-lg-4 col-sm-6">
								<?php echo get_template_part('templates/card-person-2'); ?>
							</div>
						<?php
						endwhile;
					endif;
					wp_reset_postdata(); ?>
                                     
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;
else:
/*
** Display others roles people
*/
?>
<div class="container p-0">
	<div class="row loadmore">
		<?php
		global $wp_query;
		$args = filtered_query( array(
			'post_type' => array('person'),
			'posts_per_page' => -1,
			'meta_key'  => 'last_name',
			'order' => 'ASC',
			'orderby'   => 'meta_value',
			'tax_query' => array(
				array(
					'taxonomy' => 'person_role',
					'field' => 'slug',
					'terms' => array($instance['archive_filter']),
					'operator' => 'IN',
				),
			),
		));
		$query = new WP_Query( $args );
		custom_my_load_more_scripts($query->query_vars, $query->max_num_pages, $query->current_page, 'card-person-2');
		if ( $query->have_posts() ):
			while ( $query->have_posts() ):
				$query->the_post();
				?>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<?php echo get_template_part('templates/card-person-2'); ?>
				</div>
				<?php
			endwhile;
			// echo '</div>';
			if ($query->max_num_pages > 1) {
				echo '<div class="row"><div class="col-12 text-center"><div class="custom_loadmore custom-btn">LOAD MORE</div></div></div>';
			}
		endif;
		wp_reset_postdata(); ?>

	</div>
</div>
<?php endif; ?>
<?php echo $after_widget; ?>
