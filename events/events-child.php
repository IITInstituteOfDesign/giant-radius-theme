	<header class="single_post__header single_header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="single_header__title"><?php the_title(); ?></h1>
					<?php get_template_part('templates/hero-unit') ?>
				</div>
			</div>
		</div>
	</header>

	<main class="single_post__main single_main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12">
					<!-- <div class="single_metadata">
						<div class="item">
							<div class="item_icon"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.97 8H2V4.97c0-.54.43-.97.97-.97h1.02v2h2V4h7.99v2h2V4h1a1 1 0 0 1 1 1v3zm0 9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-7h15.97v7zm-17.9.76c0 1.1.95 2.24 2.05 2.24H18.1c1.1 0 1.9-1.02 1.9-2.24l-.03-13.05c0-2.08-.28-2.71-4-2.71V0h-2v2H6V0H4v2H2a2 2 0 0 0-2 2l.06 13.76z" fill-rule="evenodd"/></svg></div>
							<div class="item_content">
								<b>Date:</b>
								<span><?php// the_date(); ?></span>
							</div>
						</div>
					</div> -->
					<article class="single_post__article single_article">
						<div class="single_article__style">
							<?php the_content(); ?>
						</div>
					</article>
				</div>
				<div class="col-lg-4 col-12">
					<aside>
						<?php get_sidebar(); ?>
						<?php if ( is_active_sidebar( 'sidebar-news' ) ) : ?>
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar( 'sidebar-news' ); ?>
							</div>
						<?php endif; ?>
					</aside>
				</div>
			</div>
		</div>
	</main>