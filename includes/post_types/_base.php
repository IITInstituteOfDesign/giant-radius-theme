<?php

if ( !class_exists('PostType') ):

class PostType {
  public $singular;
  public $plural;
  public $name;
  public $labels;
  public $message;
  public $image;
  public $taxonomies;
  public $supports;
  public $public = true;
  public $has_archive = true;
  public $queryable;

  public function __construct( $singular, $plural = null, $queryable = true ) {
    $this->singular = $singular;
    $this->name = strtolower($singular);
    $this->plural = is_null($plural) ? $singular.'s' : $plural;
    $this->supports = array('title', 'editor', 'author', 'excerpt', 'revisions', 'page-attributes');
    $this->taxonomies = array();
    $this->queryable = $queryable;

    $this->labels = array(
      'name' => _x("$this->plural", "post type general name", 'idiit-theme'),
      'singular_name' => _x("$this->singular", "post type singular name", 'idiit-theme'),
      'all_items' => sprintf( __('All %1$s', 'idiit-theme'), $this->plural),
      'add_new_item' => sprintf( __('Add New %1$s', 'idiit-theme'), $this->singular),
      'edit_item' => sprintf( __('Edit %1$s', 'idiit-theme'), $this->singular),
      'new_item' => sprintf( __('New %1$s', 'idiit-theme'), $this->singular),
      'view_item' => sprintf( __('View %1$s', 'idiit-theme'), $this->singular),
      'search_items' => sprintf( __('Search %1$s', 'idiit-theme'), $this->plural),
      'not_found' => sprintf(  __('No %1$s Found', 'idiit-theme'), $this->plural),
      'not_found_in_trash' => sprintf( __('No %1$s Found in Trash', 'idiit-theme'), $this->plural),
      'parent_item_colon' => ''
    );

    add_action( 'init', array($this, 'register_post_type'), 2, 1 );

  }

  public function register_post_type() {
    register_post_type($this->name , array(
      'labels' => $this->labels,
      'public' => $this->public,
      'has_archive' => $this->has_archive,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'menu_icon' => $this->image,
      'menu_position' => 7,
      'rewrite' => array( 'slug' => strtolower($this->plural) ),
      'supports' => $this->supports,
      'taxonomies' => $this->taxonomies,
      'publicly_queryable'  => $this->queryable,
    ));
  }
}

endif;
