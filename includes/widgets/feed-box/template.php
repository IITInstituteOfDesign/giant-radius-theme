<?php echo $before_widget; ?>
<?php
$title = esc_attr( $instance['title'] );
$btn_text = esc_attr( $instance['btn_text'] );
$show_btn = esc_attr( $instance['show_btn'] );
?>

<div class="box">
    <h2 class="box-title"><?php
    if (isset($title)) {
        echo $title;
    }?></h2>
    <?php if ( $query->have_posts() ) : ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <a class="article-container" href="<?php the_permalink(); ?>">
                <article>
                    <h3><?php the_title(); ?></h3>
                </article>
            </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
    <?php if ($show_btn == true):?>
        <div class="bottom-btn">
            <a href="<?php echo get_post_type_archive_link( $post_type ); ?>" class="custom-btn"><?php echo $btn_text; ?></a>
        </div>
    <?php endif; ?>
</div>

<?php echo $after_widget; ?>
