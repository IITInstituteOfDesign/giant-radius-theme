/*
** Converts links containing 'divider' to hr in header menu
*/
jQuery(document).ready(function($) {
	$('#head-nav a:contains("divider")').parent().addClass('divider').append('<hr>');
	$('#head-nav a:contains("divider")').hide();
});

/*
** Triggers Menu Button
*/
jQuery(document).ready(function($) {
	jQuery('#btn-menu').on('click', function(e){
		e.preventDefault();
		jQuery('body').toggleClass('menu-active');
	})
});
