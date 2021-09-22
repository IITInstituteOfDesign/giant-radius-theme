jQuery( document ).ready( function( $ ) {
	'use strict';

	var args = {
		plugins: ['drag_drop', 'remove_button'],
		delimiter: ',',
		create: false,
		onInitialize: function() {
			var selectize = this;
			var items = selectize.$input.data('items');
			if (items) {
				selectize.clear(true);
				items.split(',').forEach(function (item) {
					selectize.addItem(item, true);
				});
			}
		}
	}

	$('.form-table,.pw-widgets').find('select.form-control').selectize(args);
	$('.my-selectize').selectize(args);
	$(document).on('widget-added', function(event,$widget) {
		$widget.find('select.form-control').selectize(args);
	});
	$('#widgets-right .widgets-sortables').children('.widget').each( function(i,el) {
		$(document).trigger('widget-added', [ $(el) ]);
	});
});
