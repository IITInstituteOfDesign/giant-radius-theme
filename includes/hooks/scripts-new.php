<?php

add_action( 'wp_enqueue_scripts', function() {
  // $vendor = get_template_directory_uri() . '/vendor';
  $assets = get_template_directory_uri() . '/assets';
  $styles = $assets . '/css';
  $script = $assets . '/js';

  if ( is_singular() ) wp_enqueue_script( "comment-reply" );
  wp_enqueue_script('jquery');

  // wp_enqueue_script( 'jquery', $script . '/jquery-3.3.1.min.js');
  wp_enqueue_script( 'bootstrap', $script . '/bootstrap.bundle.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'duotone', $script . '/jquery.duotone.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'owlcarousel', $script . '/owl.carousel.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'slideshow', $script . '/app.js', array('jquery'), null, true );

  wp_enqueue_style( 'fontawesome', $styles . '/fontawesome-all.min.css' );
  wp_enqueue_style( 'bootstrap', $styles . '/bootstrap.min.css' );
  wp_enqueue_style( 'owlcarousel', $styles . '/owl.carousel.css' );
  wp_enqueue_style( 'styles', $styles . '/style.css' );
});

add_action( 'admin_enqueue_scripts', function() {
  $vendor = get_template_directory_uri() . '/vendor';
  $assets = get_template_directory_uri() . '/assets';
  $styles = $assets . '/css';
  $script = $assets . '/js';
  wp_enqueue_script( 'selectize', $vendor . '/selectize/selectize.min.js', array('jquery'), '0.12.0', true );
  wp_enqueue_script( 'admin', $script . '/admin.js', array('jquery', 'selectize'), null, true);
  wp_enqueue_style( 'selectize', $vendor . '/selectize/selectize.css' );
  wp_enqueue_style( 'selectize.default', $vendor . '/selectize/selectize.default.css' );
});


// add_action( 'wp_enqueue_scripts', function() {
//   $vendor = get_template_directory_uri() . '/vendor';
//   $assets = get_template_directory_uri() . '/assets';
//   $styles = $assets . '/stylesheets';
//   $script = $assets . '/javascripts';

//   if ( is_singular() ) wp_enqueue_script( "comment-reply" );
//   wp_enqueue_script('jquery');

//   wp_enqueue_script( 'froogaloop2', '//f.vimeocdn.com/js/froogaloop2.min.js', array(), null, true );
//   wp_enqueue_script( 'chosen', $vendor . '/chosen/chosen.jquery.min.js', array('jquery'), '1.3.0', true );
//   wp_enqueue_script( 'dotdotdot', $vendor . '/dotdotdot/jquery.dotdotdot.min.js', array('jquery'), '1.7.0', true );
//   wp_enqueue_script( 'succinct', $vendor . '/succinct/succinct.min.js', array('jquery'), '1.1.0', true );
//   wp_enqueue_script( 'flexslider', $vendor . '/flexslider/jquery.flexslider-min.js', array('jquery'), '2.3.0', true );
//   wp_enqueue_script( 'bootstrap', $vendor . '/bootstrap/dist/js/bootstrap.min.js', array('jquery'), '3.3.2', true );
//   wp_enqueue_script( 'bootstrap-hover-dropdown', $vendor . '/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js', array('jquery', 'bootstrap'), '2.1.3', true );
//   wp_enqueue_script( 'bootstrap-datepicker', $vendor . '/bootstrap-datepicker/js/bootstrap-datepicker.min.js', array('jquery', 'bootstrap'), '1.4.0', true );

//   wp_enqueue_script( 'cards', $script . '/cards.js', array('jquery'), null, true );
//   wp_enqueue_script( 'ellipsis', $script . '/ellipsis.js', array('dotdotdot'), null, true );
//   wp_enqueue_script( 'events', $script . '/events.js', array('bootstrap-datepicker'), null, true );
//   wp_enqueue_script( 'filters', $script . '/filters.js', array('chosen'), null, true );
//   wp_enqueue_script( 'footer', $script . '/footer.js', array('jquery'), null, true );
//   wp_enqueue_script( 'modals', $script . '/modals.js', array('bootstrap'), null, true );
//   wp_enqueue_script( 'more-less', $script . '/more-less.js', array('succinct'), null, true );
//   wp_enqueue_script( 'search', $script . '/search.js', array('jquery'), null, true );
//   wp_enqueue_script( 'sharing', $script . '/sharing.js', array('jquery'), null, true );
//   wp_enqueue_script( 'showmore', $script . '/showmore.js', array('jquery'), null, true );
//   wp_enqueue_script( 'sidebar', $script . '/sidebar.js', array('jquery'), null, true );
//   wp_enqueue_script( 'slideshow', $script . '/slideshow.js', array('flexslider'), null, true );

//   wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
//   wp_enqueue_style( 'chosen', $vendor . '/chosen/chosen.min.css' );
//   wp_enqueue_style( 'bootstrap-datepicker', $vendor . '/bootstrap-datepicker/css/bootstrap-datepicker3.min.css' );
//   wp_enqueue_style( 'styles', $styles . '/main.css' );
// });

// add_action( 'admin_enqueue_scripts', function() {
//   $vendor = get_template_directory_uri() . '/vendor';
//   $assets = get_template_directory_uri() . '/assets';
//   $styles = $assets . '/stylesheets';
//   $script = $assets . '/javascripts';
//   wp_enqueue_script( 'selectize', $vendor . '/selectize/selectize.min.js', array('jquery'), '0.12.0', true );
//   wp_enqueue_script( 'admin', $script . '/admin.js', array('jquery', 'selectize'), null, true);
//   wp_enqueue_style( 'selectize', $vendor . '/selectize/selectize.css' );
//   wp_enqueue_style( 'selectize.default', $vendor . '/selectize/selectize.default.css' );
// });
