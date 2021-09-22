jQuery(document).ready(function($) {
  'use strict';

	$('#current_month').datepicker({
	  minViewMode: 1
	}).on('changeDate', function(event) {
		console.log(event.date);
		window.location.href = '/events/' + event.date.getFullYear() + '/' + (event.date.getMonth() + 1);
	});
});