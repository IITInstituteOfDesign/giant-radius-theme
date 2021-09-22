

// Demo Carousel
// jQuery( document ).ready(function() {
//   jQuery('.flexslider').flexslider({
//     animation: "slide"
//   });
// });
// jQuery( document ).ready(function() {
// 	var widgetCSS = "" +
// 	"body{font-family: 'Helvetica Neue', 'Arial', sans-serif;}";

// 	window.setTimeout(function(){
// 		paint();
// 	}, 1000);

// 	function paint(){
// 		var w = document.getElementById("twitter-widget-0").contentDocument;
// 		var s = document.createElement("style");
// 		s.innerHTML = widgetCSS;
// 		s.type = "text/css";
// 		w.head.appendChild(s);
// 	}

// });


// Duo
// jQuery( document ).ready(function() {
// 	jQuery("img.duo").duotone({
// 	    gradientMap: "#b7b6c8, #e5e9f2"
// 	});
// });



jQuery( document ).ready(function() {
  h = jQuery('#head-nav').outerHeight();
  f = jQuery('.main-footer').outerHeight();
  // b = jQuery('body').css('padding-top');
  // bp = parseInt(b.replace('px', ''));
  x = h+f+100;
  jQuery('.js-min-height').css('min-height', 'calc(100vh - '+x+'px)')
});


// jQuery( document ).ready(function() {
//   console.log('inited');
//   jQuery('.slick-inline').slick({
//     lazyLoad: 'ondemand',
//     slidesToShow: 4,
//     slidesToScroll: 1,
//     adaptiveHeight: true,
//     prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8"><path d="M4 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z" transform="translate(1)" /></svg></button>',
//     nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8"><path d="M1.5 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z" transform="translate(1)" /></svg></button>'
//   });
// });


// Home Carousel

// jQuery('#sync1').slick({
//   slidesToShow: 1,
//   slidesToScroll: 1,
//   fade: true,
//   asNavFor: '#sync2',
//   arrows: false,
//   autoplay: true,
//   autoplaySpeed: 2000,
//   pauseOnFocus: false,
//   pauseOnHover: false,
//   draggable: false,
//   infinite: true,
//   lazyLoad: 'progressive'
// });
// jQuery('#sync2').slick({
//   slidesToShow: 1,
//   slidesToScroll: 1,
//   asNavFor: '#sync1',
//   arrows: false,
//   draggable: false,
//   infinite: true,
//   lazyLoad: 'progressive'

// });

// jQuery('.home-carousel').owlCarousel({
//     items: 1,
//     autoplay: true,
//     autoplayTimeout: 200,
//     autoplayHoverPause: false,
//     mouseDrag: false,
//     pullDrag: false,
//     touchDrag: false,
//     smartSpeed: 1000,
//     loop: true
// })

// jQuery('.home-carousel--top').owlCarousel({
//     items: 1,
//     autoplay: true,
//     autoplayTimeout: 200,
//     autoplayHoverPause: false,
//     mouseDrag: false,
//     pullDrag: false,
//     touchDrag: false,
//     smartSpeed: 1000,
//     loop: true
// })
// jQuery('.home-carousel--top').owlCarousel({
//     items: 1,
//     autoplay: false,
//     autoplayTimeout: 1000,
//     mouseDrag: false,
//     pullDrag: false,
//     touchDrag: false,
//     loop: true
// })

// jQuery( document ).ready(function() {
// 	jQuery('.home-carousel').on('change.owl.carousel', function(event) {
// 		jQuery('.home-carousel--top').trigger('to.owl.carousel', [event.item.index+2,1000,true]);
// 	})
// });


// Header Class
// jQuery(window).scroll(function() {    
//     var scroll = jQuery(window).scrollTop();
//     if (scroll >= 500) {
//         jQuery("#head-nav").addClass("scroll");
//     } else {
//         jQuery("#head-nav").removeClass("scroll");
//     }
// });


jQuery( document ).ready(function() {
  // var masonry = new Macy({
  //   container: '.js-macy',
  //   trueOrder: false,
  //   waitForImages: false,
  //   useOwnImageLoader: false,
  //   debug: true,
  //   // mobileFirst: true,
  //   columns: 4,
  //   margin: 24,
  //   // breakAt: {
  //   //   1200: 6,
  //   //   940: 5,
  //   //   520: 3,
  //   //   400: 2
  //   // }
  // });
  // $('.js-masonry').masonry({
  //   itemSelector: '.js-masonry-item',
  //   columnWidth: '.js-grid-sizer',
  //   percentPosition: true,
  //   fitWidth: true,
  //   horizontalOrder: true,
  //   originTop: true
  // });





});
