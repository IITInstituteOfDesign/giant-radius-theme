<?php echo $before_widget; ?>

<div class="box">
    <h2 class="box-title"><?php if (isset($instance['title'])) {
        echo $instance['title'];
    } ?></h2>
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <a class="article-container" href="<?php the_permalink(); ?>">
                <article>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo strip_tags(get_the_excerpt()); ?></p>
                </article>
            </a>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if ($instance['show_btn'] == true):?>
        <div class="bottom-btn">
            <a href='<?php echo ( null !== get_field('button_url', 'option') ) ? the_field('button_url', 'option') : '' ?>' class='custom-btn' target='_blank'>
                <?php if(isset($instance['btn_text'])){
                    echo $instance['btn_text'];
                } ?>
            </a>
        </div>
    <?php endif ?>
</div>



<?php echo $after_widget; ?>
