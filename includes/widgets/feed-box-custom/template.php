<?php echo $before_widget; ?>
<?php if ( isset($instance['type']) && $instance['type'] != ''): ?>
  <div class="box <?php echo $instance['type']; ?>">
    <?php if (isset($instance['title']) && $instance['title'] != ''): ?>
      <h2 class="box-title"><?php echo $instance['title']; ?></h2>
    <?php endif; ?>

    <?php if ($instance['type'] == 'text'):?>
      <?php if (isset($instance['text']) && $instance['text'] != ''): ?>
        <div class="box-content">
         <p><?php echo $instance['text']; ?></p>
       </div>
     <?php endif; ?>
     <?php elseif($instance['type'] == 'list'): ?>
      <div class="box-content">
        <?php foreach ($instance['type_list'] as $key => $value): ?>
          <a class="article-container" href="<?php echo isset($value['url']) ? $value['url'] : '' ?>">
            <article>
             <h3><?php echo isset($value['title']) ? $value['title'] : '' ?></h3>
             <div class="subtitle"><?php echo isset($value['text']) ? $value['text'] : '' ?></div>
           </article>
         </a>
       <?php endforeach; ?>
     </div>
     <?php elseif($instance['type'] == 'list2'): ?>
      <div class="box-content">
        <?php foreach ($instance['type_list'] as $key => $value): ?>
          <a class="article-container" href="<?php echo isset($value['url']) ? $value['url'] : '' ?>">
            <article>
             <h3><?php echo isset($value['title']) ? $value['title'] : '' ?></h3>
             <div class="subtitle"><?php echo isset($value['text']) ? $value['text'] : '' ?></div>
           </article>
         </a>
       <?php endforeach; ?>
     </div>
   <?php endif; ?>

   <?php if ($instance['show_btn'] == true):?>
    <div class="bottom-btn <?php echo $instance['btn_position']; ?>">
      <a href='<?php echo isset($instance['btn_url']) ? $instance['btn_url']: '' ?>' class='custom-btn' target='<?php echo isset($instance['target_new']) && $instance['target_new'] == true ? '_blank' : '' ?>'>
        <?php if(isset($instance['btn_text'])){
          echo $instance['btn_text'];
        } ?>
      </a>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
<?php echo $after_widget; ?>