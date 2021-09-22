<?php

add_action( 'wp_nav_menu_items', function( $items, $args ) {
	if ( $args->theme_location == 'primary' ) {
		$classlist = array('menu-item', 'search-icon');

		if (is_search()) {
			$classlist[] = 'current-menu-item';
		}

		$items .= '<li class="'. implode(' ', $classlist) .'">';
		$items .= '<a href="/?s"><br><i class="glyphicon glyphicon-search"></i> <span>Search</span></a>';
		$items .= '</li>';
	}
	return $items;
}, 1, 2);
