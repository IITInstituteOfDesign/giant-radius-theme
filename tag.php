<header class="archive_header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="archive_header__title"><?php single_tag_title(); ?></h1>
        <h2 class="archive_header__subtitle"><?php echo tag_description(); ?></h2>
      </div>
    </div>
  </div>
</header>


<main class="archive_main">
  <div class="container">
    <div class="row main-posts">
      <?php if (have_posts()): ?>
        <?php while (have_posts()) : the_post(); ?>
          <?php 
          $post_type_obj = get_post_type_object(get_post_type());
          $post_type_name = $post_type_obj->labels->singular_name;
          ?>
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <a href="<?php the_permalink(); ?>" class="archive_item">
              <span class="archive_item__type">
                <?php echo ($post_type_name == 'Post') ? 'News' : $post_type_name; ?>
              </span>
              <figure><img src="<?php echo (has_post_thumbnail() == true) ? get_the_post_thumbnail_url(get_the_ID(),'card') : get_template_directory_uri().'/assets/img/no-image.svg' ?>" alt=""></figure>
              <h3><?php the_title(); ?></h3>
            </a>
          </div>
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
