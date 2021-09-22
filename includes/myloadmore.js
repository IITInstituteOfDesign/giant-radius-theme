jQuery(function($){

	$(window).scroll(function(){
		if ( $(".misha_loadmore").length ) {
			var btn = $(".misha_loadmore").offset().top;
			var vh = $(window).height();
			if($(window).scrollTop() > (btn - vh + 80)){
				$(".misha_loadmore:not(.loading)").click();
					console.log('Loading more posts...');
			}
		}
	});


	$('.misha_loadmore').click(function(){
		if($(this).attr('data-post-type') === 'student') {
			var button = $(this),
					data = {
						'action': 'loadmore',
						'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': misha_loadmore_params.current_page,
						'post_type': 'student'
					};
		} else {
			var button = $(this),
					data = {
						'action': 'loadmore',
						'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': misha_loadmore_params.current_page,
						'post_type': $(this).attr('data-post-type')
					};
		}


		if($(this).attr('data-post-type') === 'student') {

		}

		$.ajax({
			url : misha_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
				button.addClass('loading'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) {
					// button.text( 'More posts' ).prev().before(data); // insert new posts
					button.removeClass('loading'); // change the button text, you can also add a preloader image
					button.text( 'More posts' ).parent().parent().parent().find('.main-posts').append(data); // insert new posts
					misha_loadmore_params.current_page++;

					if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page ) 
						button.remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});
