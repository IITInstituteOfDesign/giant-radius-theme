/*
** Ajax Helper - Custom Script
*/

jQuery(function($){

	// $(window).scroll(function(){
	// 	if ( $(".misha_loadmore").length ) {
	// 		var btn = $(".misha_loadmore").offset().top;
	// 		var vh = $(window).height();
	// 		if($(window).scrollTop() > (btn - vh + 80)){
	// 			$(".misha_loadmore:not(.loading)").click();
	// 			console.log('Loading more posts...')
	// 		}
	// 	}
	// });

	$('.custom_loadmore').click(function(){
		var button = $(this),
		data = {
			'action': 'ctmloadmore',
			'query': custom_loadmore_params.posts,
			'page' : custom_loadmore_params.current_page,
			'post_type' : $(this).attr('post-type')
		};

		$.ajax({
			url : custom_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
				button.addClass('loading');
			},
			success : function( data ){
				console.log(data);
				if( data ) { 
					button.removeClass('loading');
					button.text( 'More posts' ).parent().parent().parent().find('.loadmore').append(data);
					custom_loadmore_params.current_page++;

					if ( custom_loadmore_params.current_page == custom_loadmore_params.max_page ) 
						button.remove();

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove();
				}
			}
		});
	});
});