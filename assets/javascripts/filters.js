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
