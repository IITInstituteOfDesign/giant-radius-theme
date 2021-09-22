<?php echo $before_widget; ?>
<div id="accordion">
	<?php $post_id = get_the_ID(); ?>
	


	<?php $args = array( 'parent' => 0, 'orderby' => 'slug' ); ?>
	<?php $course_types = get_terms( array( 'course_type' ), $args ); ?>
	<?php $i = 0; ?>
	<?php foreach ($course_types as $course_type):
		$parent_name = $course_type->name;
		$parent_id = $course_type->term_id;
		?>
		<article class="accordion_tag">
			<div class="accordion_tag__header" id="heading<?php echo $i ?>">
				<h5 class="mb-0">
					<button data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>"><?php echo $parent_name; ?><i class="fa fa-angle-down"></i></button>
				</h5>
			</div>
			<?php
			$t = array( 'child_of' => $course_type->term_id, 'orderby' => 'slug' );
			$child = get_terms( array( 'course_type' ), $t );
			?>
			<div id="collapse<?php echo $i ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				<?php
				$args_parent = array(
					'post_type' => array('course'),
					'posts_per_page' => -1,
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'course_type',
							'terms' => $parent_id
						),
						array(
							'taxonomy' => 'course_type',
							'terms' => get_term_children( $parent_id, 'course_type'),
							'operator' => 'NOT IN'
						)
					)
					
				);
				$courses_parents = new WP_Query( $args_parent );
				if ( $courses_parents->have_posts() ) {
					echo '<div class="card-body">';
					while ( $courses_parents->have_posts() ) {
						$courses_parents->the_post();
						?>
						<a class="course_item <?php echo $post_id == get_the_ID() ? 'active' : '' ?>" href="<?php the_permalink() ?>" >
							<?php the_title(); ?>
						</a>
						<?php
					}
					echo '</div>';
				}
				wp_reset_postdata();
				?>
				<div class="card-body">
					<?php
					foreach ($child as $key => $value):
						$child_name = $value->name;
						$args_children = array(
							'post_type' => array('course'),
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'course_type',
									'field' => 'term_id',
									'terms' =>  $value->term_id,
								)
							)
						);
						?>
						<div class="child_header">
							<?php echo $child_name; ?>
						</div>
						<?php
						$courses_childs = new WP_Query( $args_children );
						if ( $courses_childs->have_posts() ) {
							while ( $courses_childs->have_posts() ) {
								$courses_childs->the_post();
								?>
								<a class="course_item <?php echo $post_id == get_the_ID() ? 'active' : '' ?>" href="<?php the_permalink() ?>" >
									<?php the_title(); ?>
								</a>
								<?php
							}
						}
						wp_reset_postdata();
					endforeach;
					?>
				</div>
			</div>
		</article>
		<?php
		$i++;
	endforeach;
	?>
</div>
<?php echo $after_widget; ?>