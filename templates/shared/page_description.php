<section id="page-description">
  <div class="column">
    <?php echo wpautop( do_shortcode( $content ) ); ?>
  </div>

  <?php if (!empty($sidebar)): ?>
    <div class="column">
      <?php echo wpautop( do_shortcode( $sidebar ) ); ?>
    </div>
  <?php endif; ?>
</section>
