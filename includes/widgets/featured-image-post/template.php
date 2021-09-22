<?php echo $before_widget; ?>
<div class="content">
    <div class="left">
        <figure>
            <?php if ($instance['image']): ?>
                <img class="<?php if($instance['img_filter'] == true){ echo 'duo'; } ?>" src="<?php echo $instance['image'] ?>" alt="Student Life">
            <?php endif; ?>
        </figure>
    </div>
    <div class="right">
        <div class="main-content">
            <h2><?php if (isset($instance['title'])) { echo $instance['title']; } ?></h2>
            <p><?php if (isset($instance['main_text'])) { echo $instance['main_text']; } ?></p>
            <?php if (isset($instance['show_btn']) && $instance['show_btn'] == true):?>
                <a href="<?php if (isset($instance['btn_url'])) { echo $instance['btn_url']; } ?>" class="custom-btn"><?php if (isset($instance['btn_text'])) { echo $instance['btn_text']; } ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php echo $after_widget; ?>
