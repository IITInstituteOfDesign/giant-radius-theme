<style>
    .term_types a,
    .tag_types a {
        color: #333243;
        text-decoration: none;
    }
    .term_types{
        margin-top:4em;
    }
</style>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<main class="project_template">
		<header class="project_template__header" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>')">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2">
						<h1 class="header_title"><?php the_title(); ?></h1>
						<div class="header_summary"><?php if (has_excerpt()) {
							the_excerpt();
						}  ?></div>
					</div>
				</div>
			</div>
		</header>
		<section class="project_template__main single_main">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2">
						<article class="single_project__article single_article">
							<div class="single_article__style">
								<?php the_content(); ?>
								<?php get_template_part('templates/artifacts') ?>
                                <div class="term_types">
									<?php the_terms( get_the_id(), 'project_type', __( "Industries: " ), " | " ); ?>
				                </div>
                                <div class="tag_types">
                                    <?php the_tags( 'Tags: ',' | ' ); ?>
                                </div>
                            </div>
						</article>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php endwhile; else : ?>
<?php endif; ?>
