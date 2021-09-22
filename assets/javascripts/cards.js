jQuery(document).ready(function($) {
  'use strict';
  
  $('.card[href="#more"]').click(function(event) {
    var $card = $(event.target).parents('.card');
    var $next = $card.next('.collapse');
    $next.replaceWith( $next.html() );
    $card.remove();
  });
});
