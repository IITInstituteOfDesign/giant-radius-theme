<style>

    .archive_header {
        padding:25px 0 0 0;
    }

    .firstProj {
        margin-bottom:2em;
    }

    .archive_main .firstProj img {
        max-width: 100%;
        width: 100%;
        height: auto;
    }

    .projTitle {
        color: #333243;
    }

    .projTitle:hover {
        text-decoration: none;
        color: inherit;
    }


</style>
<?php $loopct = 1; ?>

<header class="archive_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="archive_header__title">Projects</h1>
                <h2 class="archive_header__subtitle"><?php get_template_part('templates/page-header-text', $taxonomy); ?></h2>
                <?php echo term_description(); ?>
            </div>
        </div>
    </div>
</header>


<main class="archive_main">
    <div class="container">
	    <?php if (have_posts()): ?>
	    <?php while (have_posts()) : the_post(); ?>
            <?php if ($loopct == 1){ ?>

            <div class="row firstProj">
                <div class="col-md-6 col-sm-12">
                    <a href="<?php the_permalink(); ?>">
                        <figure><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'card') ?>" alt=""></figure>
                    </a>
                </div>

                <div class="col-md-6 col-sm-12">
                    <a href="<?php the_permalink(); ?>" class="projTitle">
                        <h3><?php the_title(); ?></h3>
                    </a>

		    <?php the_excerpt(); ?>
</div>
            </div>
            <div class="row">
            <?php } else { ?>
                    <?php if ($loopct == 2) { ?>

                    <?php } ?>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="<?php the_permalink(); ?>" class="archive_item">
                                <figure><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'card') ?>" alt=""></figure>
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </div>
                    <?php }
                $loopct++;
        endwhile; ?>
            </div>
        <?php else : ?>
            <h4><em>No matching results</em></h4>
        <?php endif; ?>

    </div>
</main>

