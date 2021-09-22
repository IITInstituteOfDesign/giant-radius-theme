<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <header class="single_profile__header single_header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="single_header__title"><?php the_title(); ?></h1>
          <figure class="single_header__featured">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>" alt="">
          </figure>
        </div>
      </div>
    </div>
  </header>

  <main class="single_profile__main single_main">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-12">
          <article class="single_profile__article single_article">
            <div class="single_article__style">
              <?php the_content(); ?>
            </div>
          </article>
        </div>
        <div class="col-lg-4 col-12">
          <aside>
            <?php get_sidebar(); ?>
            <?php if ( is_active_sidebar( 'sidebar-profile' ) ) : ?>
              <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'sidebar-profile' ); ?>
              </div>
            <?php endif; ?>
          </aside>
        </div>
      </div>
    </div>
  </main>
<?php endwhile; else : ?>
<?php endif; ?>