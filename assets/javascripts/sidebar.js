jQuery(document).ready(function($) {
  'use strict';

  $('.expander').click(function(event) {
    var $row = $(event.delegateTarget);
    var $hidden = $row.nextAll('.hidden');
    $row.remove();
    $hidden.removeClass('hidden');
  });
});
