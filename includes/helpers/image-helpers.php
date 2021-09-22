<?php

/**
 * Retrieve the attachment ID based on available ACF fields.
 * @return integer Attachment ID.
 */
function idiit_image_id() {
  if (get_sub_field('image')):
    return get_sub_field('image');
  elseif (get_sub_field('file')):
    return get_sub_field('file');
  elseif (get_field('image')):
    return get_field('image');
  elseif (has_post_thumbnail()):
    return get_post_thumbnail_id( get_the_ID() );
  endif;
}

/**
 * Retrieve file extension of attachment.
 * @param  integer $attachment_id Attachment ID.
 * @return string                 File extension of attachment.
 */
function idiit_file_extension( $attachment_id ) {
  $file = get_attached_file( $attachment_id );
  return wp_check_filetype( $file )['ext'];
}

/**
 * Attempt to generate oembed HTML for available ACF fields.
 * @return string|boolean Returns oembed code if valid URL, false otherwise.
 */
function idiit_oembed_get() {
  global $content_width;
  $args = array( 'width' => $content_width );
  $url = get_sub_field('video_url');
  $url = $url ?: get_field('url');

  // Support Vimeo Froogaloop2 API
  if (false !== strpos($url, 'vimeo.com')) {
    $matches = array();
    if (preg_match('/\d+/', $url, $matches)) {
      $url = add_query_arg( array( 'api' => 1, 'player_id' => "v{$matches[0]}" ), $url );
      $url = str_replace( array( 'https://vimeo.com', 'http://vimeo.com' ), '//player.vimeo.com/video', $url );
      return sprintf('<iframe id="v%s" src="%s" width="%s" height="%s" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', $matches[0], $url, $args['width'], 640);
    }
  }

  return wp_oembed_get( $url, $args );
}

/**
 * Print media element based on available ACF fields.
 * Uses either an <iframe>, <object>, or <img> tag.
 * @param  string $size Registered image size to use if printing an image.
 * @param  array  $args {
 *     @type boolean $static Only display static images? Default false.
 * }
 * @return null
 */
function idiit_rich_media( $size = 'full', $args = array() ) {
  $defaults = array( 'static' => false );
  $args = wp_parse_args( $args, $defaults );
  $attachment_id = idiit_image_id();
  $media = '';
  $embed = idiit_oembed_get();
	
	if (!empty($embed) && $args['static'] === false) {
		$media = sprintf('<div class="embed-responsive embed-responsive-16by9">%s</div>', $embed);
  } elseif (idiit_file_extension( $attachment_id ) === 'svg'){
    $url = wp_get_attachment_url( $attachment_id );
    $media = sprintf('<object data="%s"><img src="%s"/></object>', $url, $url);
	} else {
		$media = wp_get_attachment_image( $attachment_id, $size );
	}

  echo $media;
}

/**
 * Filter posts to only those with featured images set.
 * @param  array  $ids  Array of post IDs to filter.
 * @param  array  $args Any overriding WP_Query args.
 * @return object       WP_Query object.
 */
function idiit_get_featured_posts( $ids, $args = array() ) {
  if (!empty($ids)):
    $args = wp_parse_args($args, array(
      'post_type' => 'any',
      'post__in'  => $ids,
      'meta_key'  => '_thumbnail_id',
      'orderby'   => 'post__in'
    ));

    if (get_query_var('post_type') === 'definition'):
      $args['meta_key'] = null;
    endif;

    return new WP_Query( $args );
  endif;
}

/**
 * Displays post excerpt if not viewing a single.php page.
 * @return string The post excerpt.
 */
function idiit_slide_caption() {
  if (!is_single()):
    return get_post_field('post_excerpt', idiit_image_id());
  endif;
}




function get_image_sizes( $size = '') {
  global $_wp_additional_image_sizes;
  $sizes = array();
  $get_intermediate_image_sizes = get_intermediate_image_sizes();
  foreach( $get_intermediate_image_sizes as $_size ) {
    if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
      $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
      $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
      $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
    } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
      $sizes[ $_size ] = array(
        'width' => $_wp_additional_image_sizes[ $_size ]['width'],
        'height' => $_wp_additional_image_sizes[ $_size ]['height'],
        'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
      );
    }
  }

  if ( $size ) {
    if( isset( $sizes[ $size ] ) ) {
      return $sizes[ $size ];
    } else {
      return false;
    }
  }

  return $sizes;
}
