<?php
/**
* Initial setup and constants
*/
add_action('after_setup_theme', function() {
  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menu('primary', 'Primary');
  // register_nav_menu('footer', 'Footer');
  // register_nav_menu('social', 'Social');

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  // add_theme_support('post-formats', array('publication'));

  // Add support for HTML5 markup
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
  add_theme_support( 'admin-bar', array( 'callback' => '__return_false') );

  // Enable Jetpack development mode
  add_filter( 'jetpack_development_mode', '__return_true' );

  // Allow shortcodes in reusable text blocks
  add_filter( 'text_blocks_widget_html', 'do_shortcode' );
  add_filter( 'widget_text', 'do_shortcode' );

  // Disable default Tablepress CSS
  add_filter( 'tablepress_use_default_css', '__return_false' );
  add_filter( 'tablepress_print_name_html_tag', 'tablepress_heading_size', 10, 2 );
  function tablepress_heading_size( $tag, $table_id ) {
    $tag = 'h4';
    return $tag;
  }

  /**
  * Enable theme features
  */

  // add_theme_support('soil-clean-up');         // Enable clean up from Soil
  // add_theme_support('soil-relative-urls');    // Enable relative URLs from Soil
  // add_theme_support('soil-nice-search');      // Enable /?s= to /search/ redirect from Soil
  // add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
  // add_theme_support('jquery-cdn');            // Enable to load jQuery from the Google CDN

  // $content_width is a global variable used by WordPress for max image upload sizes
  // and media embeds (in pixels).
  //
  // Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
  // Default: 1140px is the default Bootstrap container width.
  global $content_width;
  $content_width = 1140;

  add_filter( 'storm_social_icons_use_latest', '__return_true' );
  add_filter( 'storm_social_icons_hide_text', '__return_true' );
  add_filter( 'storm_social_icons_type', create_function( '', 'return "icon-sign";' ) );


  // Disable Theme Editor
  function remove_editor_menu() {
    remove_action('admin_menu', '_add_themes_utility_last', 101);
  }
  add_action('_admin_menu', 'remove_editor_menu', 1);

  add_image_size( 'tile', ceil($content_width/2), ceil($content_width/2), true );
  add_image_size( 'card', ceil($content_width/2), ceil($content_width * 3 / 8), true );
  add_image_size( 'carousel', 1140, 640, array('center', 'center') );
  add_image_size( 'sidebar', 60, 45, true );
  add_image_size( 'sidebar-big', 120, 90, true );
  add_image_size( 'full', $content_width, false );
});

function admin_address_fields( $args ) {
  $value = get_option( $args['field_name'], '' );
  echo '<input type="text" id="'. $args['field_name'] .'" name="'. $args['field_name'] .'" value="' . esc_attr( $value ) . '" />';
}

add_action( 'admin_init', function() {
  register_setting('general', 'address1', 'esc_attr');
  register_setting('general', 'address2', 'esc_attr');
  register_setting('general', 'address3', 'esc_attr');

  add_settings_field('address1', '<label for="address1">Street Address</label>', 'admin_address_fields', 'general', 'default', array( 'field_name' => 'address1' ));
  add_settings_field('address2', '<label for="address2">Suite Number</label>', 'admin_address_fields', 'general', 'default', array( 'field_name' => 'address2' ));
  add_settings_field('address3', '<label for="address3">City, State, Zip</label>', 'admin_address_fields', 'general', 'default', array( 'field_name' => 'address3' ));
});


/**
* Register sidebars
*/
add_action('widgets_init', function() {
  register_sidebar( array(
    'name'          => __('Sidebar', 'idiit'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  ));

  // register_sidebar( array(
  //   'name'          => __('Tiles', 'idiit'),
  //   'id'            => 'sidebar-home',
  //   'before_widget' => '<div class="tile %1$s %2$s">',
  //   'after_widget'  => '</div>',
  //   'before_title'  => '<h4>',
  //   'after_title'   => '</h4>',
  // ));

  register_sidebar( array(
    'name'          => __('Sidebar Project Page', 'idiit'),
    'id'            => 'sidebar-project',
    'description'   => 'Widgets in common for all Project Pages',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __('Sidebar Pages', 'idiit'),
    'id'            => 'sidebar-pages',
    'description'   => 'Widgets for pages post type',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __('Sidebar News Page', 'idiit'),
    'id'            => 'sidebar-news',
    'description'   => 'Widgets in common for all News Pages',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __('Sidebar People Page', 'idiit'),
    'id'            => 'sidebar-people',
    'description'   => 'Widgets in common for all People Pages',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __('Sidebar Profile Page', 'idiit'),
    'id'            => 'sidebar-profile',
    'description'   => 'Widgets in common for all Profile Pages',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ));
  register_sidebar( array(
    'name'          => __('Projects Archive Header', 'idiit'),
    'id'            => 'sidebar-project-archive',
    'description'   => 'Widget to add custom heading to Project Archive List Page',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ));












});

add_action('admin_head', function() {
  $admin_css = get_template_directory_uri() . '/assets/stylesheets/admin.css';
  echo "<link rel='stylesheet' href='$admin_css' type='text/css' media='all' />";
});

add_filter('upload_mimes', function ( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}, 1000);

add_filter('after_switch_theme', function() {
  flush_rewrite_rules();
});

add_action( 'init', function() {
  // unregister_taxonomy_for_object_type('post_tag', 'post');
  unregister_taxonomy_for_object_type('category', 'post');
  register_taxonomy_for_object_type('topic', 'post');
});
