<?php

/**
 * Retrieve card thumbnail.
 *
 * Runs the post through conditional logic based on ACF field availability.
 * 
 * @param  boolean $placeholder Use empty image if an one doesn't exist?
 * @return string               HTML code for image.
 */
function get_the_image($placeholder = false) {
  if (get_field('image')):
    $image = wp_get_attachment_image( get_field('image'), 'card' );
    return sprintf('<div class="letterbox">%s</div>', $image);
  elseif (has_post_thumbnail()) :
    $image = get_the_post_thumbnail( get_the_ID(), 'card' );
    return sprintf('<div class="letterbox">%s</div>', $image);
  elseif (get_post_type() === 'definition'):
    return sprintf('<div class="img-placeholder"><div class="definition">%s</div></div>', get_the_content());
  elseif ($placeholder === true):
    return '<div class="img-placeholder"></div>';
  endif;
}

/**
 * Display card thumbnail.
 *
 * Appropriate card thumbnail is displayed based on ACF field availability.
 *
 * @see get_the_image()
 * @param  boolean $placeholder Use empty image if an one doesn't exist?
 * @return null
 */
function the_image($placeholder = false) {
  echo get_the_image( $placeholder );
}
