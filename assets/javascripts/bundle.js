/*
** Ellipsis.js
*/
jQuery(document).ready(function($) {
  'use strict';
  
  $('.tile .ellipsis').each(function(i,el) {
    var $el = $(el);
    var $parent = $el.parents('.tile').children('a');
    var height = null;
    if (!$el.parents('.tile').hasClass('widget_quote')) {
      height = $parent.height() - $parent.children('header').height();
    }

    $el.dotdotdot({
      height: height,
      watch: true,
      lastCharacter: {
        after: '.close-quote',
        remove: [ ' ', ',', ':', ';', '.', '!', '?', '...' ],
        noEllipsis: []
      }
    });
  });
});


/*
** Events.js
*/
jQuery(document).ready(function($) {
  'use strict';

  console.log('here');

	$('#current_month').datepicker({
	  minViewMode: 1
	}).on('changeDate', function(event) {
		console.log(event.date);
		window.location.href = '/events/' + event.date.getFullYear() + '/' + (event.date.getMonth() + 1);
	});
});


/*
** Filters.js
*/
jQuery(document).ready(function($) {
  'use strict';

  var $form = $('form.filters');

  $form.find('select').each(function(index,el) {
    var $select = $(el);
    var args = {};

    if ($form.children('.breadcrumb').length > 0) {
      args.disable_search = true;
      args.width = 'auto';
    } else {
      args.width = '100%';
    }

    $select.chosen(args);
  });

  $form.find('select').on('change', function(event, params) {
    $form.submit();
  });

  $form.find('input.form-control').keypress(function(event) {
    if (event.which === 13) {
      event.preventDefault();
      $form.submit();
    }
  });
});


/*
** Modal.js
*/
jQuery(document).ready(function($) {
  'use strict';
  $('.modal').modal('show');
});


/*
** More-Less.js
*/
jQuery(document).ready(function($) {
	'use strict';

	var MoreLess = function ($el) {
		this.$el = $el;
		this.fullText = $el.html();
		this.truncate = parseInt( $el.data('truncate') );
		this.$link = null;

		this.showMore = function() {
			if ( this.truncate ) {
				this.$el.html( this.fullText );
				this.$link = $('<a href="#show-less">Less...</a>');
				this.$el.after( this.$link );
				this.bindings( this.$link );
			}
		};

		this.showLess = function() {
			if ( this.truncate ) {
				this.$link = $('<a href="#show-more">More...</a>');
				this.$el.succinct({	size: this.truncate + 5, ignore: false, omission: '' });
				this.$el.after( this.$link );
				this.bindings( this.$link );
			}
		};

		this.toggle = function(event) {
			event.preventDefault();
			this.removeLink();

			if (event.target.hash === '#show-more') {
				this.showMore();
			} else {
				this.showLess();
			}
		};

		this.bindings = function($link) {
			$link.on('click', $.proxy(this.toggle, this));
		};

		this.removeLink = function() {
			if (this.$link) {
				this.$link.remove();
			}
		};

		this.showLess();
	};

	$('.truncate').each(function(index, el) {
    new MoreLess( $(el) );
  });
});


/*
** Search.js
*/
jQuery(document).ready(function($) {
	'use strict';

  $('#search-tabs a').click(function(event) {
    event.preventDefault();
    var id = event.delegateTarget.hash;
    $(event.delegateTarget).parent().addClass('active').siblings().removeClass('active');
    if (id) {
      $(id).show().siblings().hide();
    } else {
      $('.results > .search-row').show();
    }
  });

  $(document).on('click', function(event) {
    var $target = $(event.target);

    if ($target.parents('.search-icon').length > 0) {
      event.preventDefault();
    }

    if (!$('body').hasClass('search')) {
      if ($target.parents('.search-icon').length > 0 || $target.hasClass('.search-icon')) {
        $('.search-icon').toggleClass('active');
        $('#search-form').toggle();
      } else if ($target.parents('#search-form').length === 0 && $target.attr('id') !== 'search-form') {
        $('#search-form').hide();
        $('.search-icon').removeClass('active');
      }
    }
  });
});


/*
** Sharing.js
*/

jQuery(document).ready(function($) {
  'use strict';

  $('#share-button a[target="_blank"]').click(function(e) {
    var id = $(this).data('windowid');
    if(id === null || id.closed) {
      id =  window.open($(this).attr('href'), '_blank', 'top=100,left=300,width=550,height=550');
    }
    id.focus();
    $(this).data('windowid', id);
    e.preventDefault();
    return false;
  });
});




/*
** Showmore.js
*/
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


/*
** Sidebar.js
*/
jQuery(document).ready(function($) {
  'use strict';

  $('.expander').click(function(event) {
    var $row = $(event.delegateTarget);
    var $hidden = $row.nextAll('.hidden');
    $row.remove();
    $hidden.removeClass('hidden');
  });
});



/*
** Slideshow.js
*/
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
