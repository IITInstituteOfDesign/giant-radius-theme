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
