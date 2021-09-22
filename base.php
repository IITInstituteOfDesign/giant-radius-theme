<?php ob_start(); ?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
	<meta name="google-site-verification" content="DUO2Hh2Ij6W8MPWfYXRONk5zlPKzUJCFfNzbrsgY3Cg" /> 
	

<!-- Global site tag (gtag.js) - Google Ads: 732092965 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-732092965"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-732092965'); </script>


<?php
    $slug = get_post_field( 'post_name', get_post() );
    if ($slug == 'lp-master-of-design-methods') {
?>

    <!-- Event snippet for Submit lead form (Spring/Summer MDM 2021) conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-732092965/k4f2CPmZqL0CEKW0i90C', 'event_callback': callback }); return false; } </script> 
<?php } ?>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="preload" as="font" href="/wp-content/themes/id-iit-main/assets/fonts/HelveticaNeue-Medium.woff2" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" as="font" href="/wp-content/themes/id-iit-main/assets/fonts/HelveticaNeue-Bold.woff2" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" as="font" href="/wp-content/themes/id-iit-main/assets/fonts/HelveticaNeue.woff2" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" as="font" href="/wp-content/themes/id-iit-main/assets/fonts/HelveticaNeue-Italic.woff2" type="font/woff2" crossorigin="anonymous">
    <?php wp_head(); ?> 
    <!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '1514931638654832');
	  fbq('track', 'Pa	geView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=1514931638654832&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
  </head>

<svg class="duotone-filters" xmlns="http://www.w3.org/2000/svg">  
    <filter id="duotone_grey">
        <feColorMatrix type="matrix" values="0.2126 0.7152 0.0722 0 0
            0.2126 0.7152 0.0722 0 0
            0.2126 0.7152 0.0722 0 0
            0 0 0 1 0" result="gray">
        </feColorMatrix>

        <feComponentTransfer color-interpolation-filters="sRGB" result="duotone">
            <feFuncR type="table" tableValues="0.717647059 0.898039216"></feFuncR>
            <feFuncG type="table" tableValues="0.71372549 0.91372549"></feFuncG>
            <feFuncB type="table" tableValues="0.784313725 0.949019608"></feFuncB>
            <feFuncA type="table" tableValues="0 1"></feFuncA>
        </feComponentTransfer>
    </filter>
  
</svg>

  <body <?php body_class(); ?>>
    <?php get_header(); ?>

    <!-- <main role="main"> -->
      <!-- <div class="container"> -->
        <?php include template_path(); ?>
      <!-- </div> -->
    <!-- </main> -->
    <?php get_footer(); ?>
    <?php wp_footer(); ?>
    <script type="text/javascript">
      jQuery(document).ready(function(){
	  jQuery('#join_graduate a.custom-btn').attr('target', '_blank');
	  jQuery('.js_hero_unit').slick({
		infinite: true,
		slidesToShow: 1,
		arrows: true,
		prevArrow: '<div class="slick-prev"></div>',
		nextArrow: '<div class="slick-next"></div>',
		autoplay: true,
		lazyLoad: 'ondemand'
	  })

		/**
		 * Check a href for an anchor. If exists, and in document, scroll to it.
		 * If href argument ommited, assumes context (this) is HTML Element,
		 * which will be the case when invoked by jQuery after an event
		 */

		function scroll_if_anchor(href) {
		    href = typeof(href) == "string" ? href : jQuery(this).attr("href");
		    
		    // You could easily calculate this dynamically if you prefer
		    var fromTop = 60;
		    
		    // If our Href points to a valid, non-empty anchor, and is on the same page (e.g. #foo)
		    // Legacy jQuery and IE7 may have issues: http://stackoverflow.com/q/1593174
		    if(href.indexOf("#") == 0) {
			var $target = jQuery(href);
			
			// Older browser without pushState might flicker here, as they momentarily
			// jump to the wrong position (IE < 10)
			if($target.length) {
			    jQuery('html, body').animate({ scrollTop: $target.offset().top - fromTop });
			    if(history && "pushState" in history) {
				history.pushState({}, document.title, window.location.pathname + href);
				return false;
			    }
			}
		    }
		}    

		// When our page loads, check to see if it contains and anchor
		scroll_if_anchor(window.location.hash);

		// Intercept all anchor clicks
		jQuery("body").on("click", "a", scroll_if_anchor);

		jQuery( document )
		    .on('click', '#nf-field-182', function() {
		      return gtag_report_conversion('https://id.iit.edu/lp-master-of-design-methods/');
		});
	}); //end document ready


	function fnScrollToDiv(arg)
	{
	    jQuery('html, body').animate({
	        scrollTop: jQuery("#"+arg).offset().top-80
            }, 500);
	}

	</script>
  </body>
</html>
