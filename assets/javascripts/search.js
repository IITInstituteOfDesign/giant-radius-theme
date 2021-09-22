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
