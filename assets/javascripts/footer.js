jQuery(document).ready(function($) {
  'use strict';
  
  $(window).on('load resize', function() {
    var $footer = $('body > footer');
    $('body').css('padding-bottom', $footer.outerHeight());
    $('main').css('min-height', $('html').height() - $footer.outerHeight() - $('main').offset().top);
  });
});
