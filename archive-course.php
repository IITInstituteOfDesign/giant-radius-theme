<?php

$name = get_query_var('post_type');
if ('any' === $name || empty($name)):
	$name = 'post';
endif;
$post_type = get_post_type_object( $name );
$content = $post_type->description;
$sidebar = get_option( sprintf('idiit_%s_sidebar', $post_type->name) );
$content = apply_filters('the_content', $content );

?>

<header class="archive_header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="archive_tag_filter">					
					<h1 class="archive_header__title"><?php echo $post_type->label ?></h1>
					<div class="dropdown show" id="dropdown-filter-course">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item active" data-value="all" href="#">All</a>
							<?php 
							/* Query Arguments*/					
							$taxonomies = array( 
								'course_type',
							);
						
							$args = array(
								'orderby'           => 'name', 
								'order'             => 'ASC',
								'hide_empty'        => true, 
								'parent'            => 0,
								'hierarchical'      => true,
								'child_of'          => 0,
								'pad_counts'        => false,
							);
						
							$coursecats = get_terms($taxonomies, $args);
							foreach ( $coursecats as $coursecat ):
							?>
								<a class="dropdown-item dropdown-parent-item" data-value="<?php echo $coursecat->term_id ?>"><?php echo $coursecat->name ?></a>
								<?php
								$subcoursecats = get_terms($taxonomies, array( 'parent' => $coursecat->term_id, 'hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC' ));
								foreach ( $subcoursecats as $subcoursecat ):
								?>
								<a class="dropdown-item" data-value="<?php echo $subcoursecat->term_id ?>"><?php echo $subcoursecat->name ?></a>
								<?php endforeach; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>


<main class="archive_main" id="course_divs">
	<div class="container">
		<div class="row">
			<?php get_template_part('templates/collection', $post_type->name); ?>
		</div>
	</div>
</main>

<script>
	jQuery( document ).ready(function( $ ) {
		$('#dropdown-filter-course .dropdown-item').on('click', function(e){
			$('#dropdown-filter-course .dropdown-item').removeClass('active');
			$(this).addClass('active');
			var v = $(this).attr('data-value');
			var t = $(this).text();
			$(this).parent().parent().find('.dropdown-toggle').html(t)

			if (v == 'all') {
				$('.course-all, .course-divider--content, .course-tp').show();
			}else{
				$('.course-tp, .course-divider--content, .course-all').show();
				$('.course-all:not(#'+v+')').hide();
				$('.course-'+v).show();
				$( ".course-tp" ).each( function( index, element ){
					if($( this ).find('.course-all:visible').length == 0){
						$(this).hide()
					}
				});
				$( ".course-tp:visible" ).each( function( index, element ){
					$( ".course-divider--content" ).each( function( index, element ){
						if($( this ).find('.course-all:visible').length == 0){
							$(this).hide()
						}
					});
				});
			}
			
			$('html, body').animate({
				scrollTop: $("#course_divs").offset().top
			}, 1000);
		})
	});

</script>