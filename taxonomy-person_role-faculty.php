<?php

if (is_post_type_archive() || is_home()):
	$name = get_query_var('post_type');
	if ('any' === $name || empty($name)):
		$name = 'post';
	endif;
	$post_type = get_post_type_object( $name );
	$content = $post_type->description;
	$sidebar = get_option( sprintf('idiit_%s_sidebar', $post_type->name) );
elseif (is_tax() || is_category()):
	$name = get_query_var('term');
	$term = get_term_by('slug', $name, get_query_var('taxonomy'));
	$term_meta = get_option( "taxonomy_term_$term->term_id" );
	$content = category_description();
	$sidebar = isset($term_meta['sidebar']) ? $term_meta['sidebar'] : null;
else:
	$name = get_query_var('post_type');
	$name = empty($name) ? 'post' : $name;
	$content = get_the_content();
endif;

$content = apply_filters('the_content', $content );

?>

<?php $term = get_query_var('term'); ?>
<?php $taxonomy = get_query_var('taxonomy'); ?>
<?php $tax_obj = get_taxonomy($taxonomy); ?>

<header class="archive_header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php get_template_part('templates/page-header-text', $taxonomy); ?>
				<!-- <h2 class="archive_header__subtitle"><?php //echo $tax_obj->label ?></h2> -->
			</div>
		</div>
	</div>
</header>
<!-- Tax Description -->
<?php
$name = get_query_var('term');
$term = get_term_by('slug', $name, get_query_var('taxonomy'));
$term_meta = get_option( "taxonomy_term_$term->term_id" );
$content = category_description();
$sidebar = isset($term_meta['sidebar']) ? $term_meta['sidebar'] : null;
?>
<?php if (!empty($content)): ?>
	<section class="tax-description">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="box main-box">
						<?php echo $content; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<!-- Tax Description End -->


<main class="archive_main archive_faculty__main">
	<div class="container">
		<!-- <div class="row"> -->

			<?php if (empty(get_query_var('filters')) && is_tax('person_role', 'faculty')): ?>
				<?php $terms = array('full-time', 'adjunct', 'emeritus'); ?>
				<?php foreach ($terms as $term): ?>
					<?php
					global $wp_query;
					$args = filtered_query( array(
						'post_type' => 'person',
						'nopaging'  => true,
						'meta_key'  => 'last_name',
						'orderby'   => 'meta_value',
						'order'     => 'ASC',
						'meta_query' => array(
							array(
								'key' => 'designation',
								'value' => $term
							)
						)
					));

					$wp_query = new WP_Query($args);
					?>

					<section class="row">
						<div class="col-12">
							<h2 class="faculty_name"><?php printf( '%s Faculty', ucwords($term)); ?></h2>
						</div>
						<?php if (have_posts()): ?>	
							<?php while (have_posts()) : the_post(); ?>
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
									</div>

								<?php endwhile; ?>
							<?php else : ?>
								<h4><em>No matching results</em></h4>
							<?php endif; ?>
						</section>
					<?php endforeach; ?>
					<?php wp_reset_query(); ?>
				<?php endif; ?>
			</div>
		</main>

