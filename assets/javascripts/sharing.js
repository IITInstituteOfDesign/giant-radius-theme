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
