<?php

add_shortcode( 'showmore', function ( $atts, $content ){
	$atts = shortcode_atts( array(
		'visible' => 3,
		'more_text' => 'More...',
		'less_text' => 'Less...'
	), $atts);
	$content = "<div class='showmore' data-visible='{$atts['visible']}' data-more='{$atts['more_text']}' data-less='{$atts['less_text']}'><div class='items'>$content</div></div>";
	return $content;
});
