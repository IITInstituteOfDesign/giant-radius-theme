<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


  <header class="single_course__header single_header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="single_header__title"><?php the_title(); ?></h1>
          <?php get_template_part('templates/hero-unit') ?>
        </div>
      </div>
    </div>
  </header>

  <main class="single_course__main single_main">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-12">
          <article class="single_course__article single_article">
            <div class="single_article__style">
              <?php the_content(); ?>
            </div>
          </article>
        </div>
        <div class="col-lg-4 col-12">
          <aside>
            <?php get_sidebar(); ?>
            <?php if ( is_active_sidebar( 'sidebar-course' ) ) : ?>
              <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'sidebar-course' ); ?>
              </div>
            <?php endif; ?>
          </aside>
        </div>
      </div>
    </div>
  </main>
<?php endwhile; else : ?>
<?php endif; ?>