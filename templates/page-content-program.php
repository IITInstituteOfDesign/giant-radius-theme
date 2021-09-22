
	<header class="program-single--header">
		<div class="badge-page">
			<div class="container">
				<div class="row">
					<div class="col-lg-5">
						<div class="main-text">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="featured-image">
							<?php the_post_thumbnail( 'medium_large' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main class="main-container--page">
		<div class="program-single--container">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="box-apply--top">
							<h5>INTERESTED?</h5>
							<h2>Apply to this program</h2>
							<a href="#" class="custom-btn">APPLY NOW</a>
						</div>
						<div class="box main-box">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<aside>
						
              <?php if (isset($sidebar) && !empty($sidebar)): ?>
                <?php echo apply_filters('the_content', $sidebar ); ?>
              <?php elseif (is_single() || is_page()): ?>
                <?php get_sidebar( $name ); ?>
              <?php endif; ?>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</main>