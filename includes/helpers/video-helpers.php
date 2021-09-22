<?php

/**
 * Get vimeo ID
 * @param URL like //player.vimeo.com/video/MY-ID?api=1&player_id=vMY-ID
 */
function get_vimeo_id( $url ) {
	$explode = explode('player_id=v', $url);
	$id = end($explode);
	return $id;
}

/**
 * Get vimeo Thumbnail
 * @param URL like //player.vimeo.com/video/MY-ID?api=1&player_id=vMY-ID
 */
function get_vimeo_thumbnail( $url ) {
	$id = get_vimeo_id($url);
	$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
	return $hash[0]['thumbnail_medium']; 
}

/**
 * Get vimeo Title
 * @param URL like //player.vimeo.com/video/MY-ID?api=1&player_id=vMY-ID
 */
function get_vimeo_title( $url ) {
	$id = get_vimeo_id($url);
	$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
	return $hash[0]['title']; 
}

/**
 * Get vimeo URL
 * @param URL like //player.vimeo.com/video/MY-ID?api=1&player_id=vMY-ID
 */
function get_vimeo_url( $url ) {
	$id = get_vimeo_id($url);
	$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
	return $hash[0]['url']; 
}