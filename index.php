<?php
$post_type = get_query_var('post_type');
if ('any' === $post_type || empty($post_type)):
	$post_type = 'post';
endif;
$post_type = get_post_type_object( $post_type );
$post_type_name = $post_type->name;i
?>
<header class="archive_header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php get_template_part('templates/page-header-text', $post_type->name); ?>
				<!-- <h1 class="archive_header__subtitle">My custom template subtitle</h1> -->
			</div>
		</div>
	</div>
</header>

<main class="archive_main">
	<div class="container">
		<div class="row main-posts">
			<?php if (have_posts()): ?>
				<?php while (have_posts()) : the_post(); ?>
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
					<?php else: ?>
					<div class="col-xl-3 col-lg-4 col-sm-6 ">
							<a href="<?php the_permalink(); ?>" class="archive_item here">
								<figure><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'card') ?>" alt=""></figure>
								<h3><?php the_title(); ?></h3>
							</a>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			<?php else : ?>
				<h4><em>No matching results</em></h4>
			<?php endif; ?>
			<?php if (!empty(paginate_links())):?>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<div class="misha_loadmore custom-btn">LOAD MORE</div>
				</div>
				<?php //get_template_part('templates/pagination'); ?>
			<?php endif; ?>
		</div>
	</div>
</main>


