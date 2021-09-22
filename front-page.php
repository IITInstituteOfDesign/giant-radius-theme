	<header id="home-head">
		<div class="container container--top">
			<div class="row">
				<div class="col-left col-lg-4 ">
					<?php if (get_field('main-content') != '') {
						the_field('main-content');
					} ?>
				</div>
				<div class="col-lg-8">
					<?php if( have_rows('slides') ): ?>
						<div class="home_slider">
							<?php while ( have_rows('slides') ) : the_row(); ?>
								<div class="home_slider__item" <?php if(get_sub_field('link')!="") { ?>onClick="document.location.href='<?php the_sub_field('link') ?>'"<?php } ?> style="background-image: url(<?php echo get_sub_field('image') ? get_sub_field('image')['sizes']['full'] : '' ?>)">									
									<div class="home_slider__content">
										<h4><?php the_sub_field('title') ?></h4>
										<p><?php the_sub_field('text') ?></p>
									</div>									
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
<main class="main-container">
	<div class="container">
		<?php the_content(); ?>
	</div>
</main>

<script>
	jQuery(function($){
		$('.home_slider').slick({
			infinite: true,
			slidesToShow: 1,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 6000,
		});
	})
</script>
