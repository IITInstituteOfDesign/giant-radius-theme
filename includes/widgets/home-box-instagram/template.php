<?php echo $before_widget; ?>
    <?php
    if ($instance['show_header'] == true) {
       $show_header = 'true';
    }else{
       $show_header = 'false';
    }
    if ($instance['show_load_btn'] == true) {
       $show_load_btn = 'true';
    }else{
       $show_load_btn = 'false';
    }
    if ($instance['show_follow_btn'] == true) {
       $show_follow_btn = 'true';
    }else{
       $show_follow_btn = 'false';
    }
    if (isset($instance['num']) && $instance['num'] != '') {
        $num = $instance['num'];
    }else{
        $num = '1';
    }
    if (isset($instance['cols']) && $instance['cols'] != '') {
        $cols = $instance['cols'];
    }else{
        $cols = '1';
    }

    ?>

    <div class="social-instagram">
        <?php echo (isset($instance['title']) && $instance['title'] != '') ? '<h2 class="box-title">'.$instance['title'].'</h2>' : ''; ?>
        <?php echo '[instagram-feed
        showheader='.$show_header.' 
        showbutton='.$show_load_btn.' 
        showfollow='.$show_follow_btn.' 
        num='.$num.'
        cols='.$cols.' ]'
        ?>
    </div>

<?php echo $after_widget; ?>
