jQuery(document).ready(function($) {
	'use strict';

	$('.showmore').each(function(index, el) {
		var $el = $(el);
		var $items = $(el).find('.items').children().not('br');
		var visible = parseInt($el.data('visible'));
		$items.eq(visible).nextAll().addBack().hide();

		if ($items.length > visible) {
			var more_text = $(el).data('more');
			var less_text = $(el).data('less');
			var $toggle = $('<a href="#showmore">' + more_text + '</a>');
			$(el).append($toggle);
			$toggle.click(function(event) {
				event.preventDefault();
				var $target = $(event.target);
				$items.eq(visible).nextAll().addBack().toggle();

				if ($target.text() === less_text) {
					$target.text(more_text);
				} else {
					$target.text(less_text);
				}
			});
		}
	});
});
