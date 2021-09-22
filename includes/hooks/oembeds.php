<?php

add_action( 'embed_oembed_html', function ($code) {
	if ( stripos( $code, 'iframe' ) !== FALSE ) {
  	$code = str_replace('<iframe', '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item"', $code);
		$code = str_replace('</iframe>', '</iframe></div>', $code);
	}
  return $code;
});