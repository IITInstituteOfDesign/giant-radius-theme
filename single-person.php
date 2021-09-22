<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <main class="single_person__main single_main">
    <?php

    // foreach (get_field('artifact') as $key => $value) {
    //     if (get_field('file', $value)) {
    //       $file_id = get_field('file', $value);
    //       echo "FILE ID: ".get_field('file', $value)."<br>";
    //       echo "<br>";
    //     }elseif (get_field('url', $value)) {
    //       $url = get_field('url', $value);
    //       echo "URL: ".get_field('url', $value)."<br>";
    //       echo "<br>";
    //     }elseif (has_post_thumbnail($value)) {
    //       $image_id = get_post_thumbnail_id($value);
    //       echo "IMAGE: ".$image_id;
    //       echo "<br>";
    //     }
    // };

    ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-12">
          <figure class="single_header__featured">
            <h1 class="single_header__title"><?php the_title(); ?></h1>
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'carousel') ?>" alt="">
          </figure>
          <?php if (get_the_content()):?>
            <article class="single_person__article single_article">
              <div class="single_article__style">
                <?php the_content(); ?>
              </div>
              <?php get_template_part('templates/artifacts-person') ?>
            </article>
          <?php endif; ?>
        </div>
        <div class="col-lg-4 col-12">
          <aside>
            <?php get_template_part('templates/metadata-person') ?>
            <?php get_sidebar(); ?>
            <?php if ( is_active_sidebar( 'sidebar-people' ) ) : ?>
              <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'sidebar-people' ); ?>
              </div>
            <?php endif; ?>
          </aside>
        </div>
      </div>
    </div>
  </main>
<?php endwhile; else : ?>
<?php endif; ?>