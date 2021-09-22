<div class="pagination pagination-list">
  <?php
  echo paginate_links( array(
    'type' => 'list',
    'prev_text' => __('«'),
    'next_text' => __('»'),
  ));
  ?>
</div>