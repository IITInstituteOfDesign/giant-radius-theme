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
