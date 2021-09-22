jQuery(document).ready(function($) {
	'use strict';
	$('.js-flexslider').each(function(index,el) {
		var $el = $(el);

		function ready(playerId) {
			var froogaloop = $f(playerId);
			froogaloop.addEvent('play', function() {
				$el.flexslider('pause');
			});
			froogaloop.addEvent('pause', function() {
				$el.flexslider('play');
			});
		}

		// Vimeo API nonsense
		$el.find('iframe[src*="//player.vimeo.com"]').each(function(i,player) {
			$f(player).addEvent('ready', ready);
		});

		// Begin flexslider
		var args = {
			animation: 'slide',
			nextText: '',
			prevText: '',
			useCSS: true,
			pauseOnHover: false,
			smoothHeight: false,
			slideshow: $el.data('slideshow'),
			start: function(slider) {
				if (slider.count === 1)	{
					slider.directionNav.remove();
				}
			}
		};

		if ($el.hasClass('inline')) {
			args.minItems = 1;
			args.maxItems = 4;
			args.itemWidth = 285;
			args.itemMargin = 0;
		}

		$el.flexslider(args);
	});

	$('.js-flexslider-auto').each(function(index,el) {
		var $el = $(el);

		function ready(playerId) {
			var froogaloop = $f(playerId);
			froogaloop.addEvent('play', function() {
				$el.flexslider('pause');
			});
			froogaloop.addEvent('pause', function() {
				$el.flexslider('play');
			});
		}

		// Vimeo API nonsense
		$el.find('iframe[src*="//player.vimeo.com"]').each(function(i,player) {
			$f(player).addEvent('ready', ready);
		});

		// Begin flexslider
		var args = {
			animation: 'slide',
			nextText: '',
			prevText: '',
			useCSS: true,
			pauseOnHover: true,
			smoothHeight: true,
			slideshow: $el.data('slideshow'),
			start: function(slider) {
				if (slider.count === 1)	{
					slider.directionNav.remove();
				}
			}
		};

		if ($el.hasClass('inline')) {
			args.minItems = 1;
			args.maxItems = 4;
			args.itemWidth = 285;
			args.itemMargin = 0;
		}

		$el.flexslider(args);
	});


	function setEqualHeight(selector) {
		$('.js-flexslider-equal').removeClass('js-active-equal');
		setTimeout(function() {
			var heights = new Array();
			$(selector).each(function() {
				$(this).css('min-height', '0');
				$(this).css('max-height', 'none');
				$(this).css('height', 'auto');
				heights.push($(this).height());
			});
			var max = Math.max.apply( Math, heights );
			$(selector).each(function() {
				$(this).css('height', max + 'px');
			}); 
			// console.log('Slider Active Equal');
			$('.js-flexslider-equal').addClass('js-active-equal');
		}, 1000);
	}
	setEqualHeight('.js-flexslider-equal .slides li');
	$(window).resize(function() {
		setEqualHeight('.js-flexslider-equal .slides li');
	});

});
