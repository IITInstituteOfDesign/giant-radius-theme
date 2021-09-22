<?php

if ( !class_exists('Taxonomy') ):

class Taxonomy {
  public $singular;
  public $plural;
  public $name;
  public $slug;
  public $labels;
  public $options_base;
  public $message;
  public $hierarchical = true;
  public $show_in_nav_menus = true;
  public $meta_box_cb = null;

  public function __construct( $singular, $plural = null, $name = null, $slug = null ) {
    $this->singular = $singular;
    $this->name = is_null($name) ? str_replace(' ', '_', strtolower($singular)) : $name;
    $this->plural = is_null($plural) ? $singular.'s' : $plural;
    $this->slug = is_null($slug) ? str_replace(' ', '_', strtolower($this->plural)) : $slug;

    $this->labels = array(
      'name' => _x( $this->plural, 'taxonomy general name', 'idiit-theme'),
      'singular_name' => _x( $this->singular, 'taxonomy singular name', 'idiit-theme'),
      'search_items' => sprintf( __('Search %1$s', 'idiit-theme'), $this->singular),
      'all_items' => sprintf( __('All %1$s', 'idiit-theme'), $this->plural),
      'parent_item' => sprintf( __('Parent %1$s', 'idiit-theme'), $this->singular),
      'parent_item_colon' => sprintf( __('Parent %1$s:', 'idiit-theme'), $this->singular),
      'edit_item' => sprintf( __('Edit %1$s', 'idiit-theme'), $this->singular),
      'update_item' => sprintf( __('Update %1$s', 'idiit-theme'), $this->singular),
      'add_new_item' => sprintf( __('Add New %1$s', 'idiit-theme'), $this->singular),
      'new_item_name' => sprintf( __('New %1$s Name', 'idiit-theme'), $this->singular),
    );

    add_action( 'init', array($this, 'register_taxonomy'), 1, 1 );
    add_action( 'admin_init', array($this, 'register_options') );
    add_action( sprintf('%s_edit_form_fields', $this->name), array($this, 'render_options'), 10, 2 );
    add_action( sprintf('edited_%s', $this->name), array( $this, 'update_options' ), 10, 2 );
  }

  public function register_taxonomy() {
    register_taxonomy($this->name , null, array(
      'labels' => $this->labels,
      'public' => true,
      'show_ui' => true,
      'show_in_nav_menus' => $this->show_in_nav_menus,
      'show_admin_column' => true,
      'hierarchical' => $this->hierarchical,
      'meta_box_cb' => $this->meta_box_cb,
      'query_var' => true,
      'rewrite' => array( 'slug' => $this->slug )
    ));
  }

  public function get_posts( $term ) {
    return get_posts("post_type=any&posts_per_page=-1&$this->name=$term->slug");
  }

  public function register_options() {
    register_setting( $this->options_base, 'featured' );
    register_setting( $this->options_base, 'sidebar' );
  }

  public function update_options( $term_id, $tax_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
      $post = array_map('stripslashes_deep', $_POST);
      $term_meta = get_option( "taxonomy_term_$term_id" );
      $cat_keys = array_keys( array_merge( $term_meta, $post['term_meta'] ) );
      foreach ( $cat_keys as $key ){
        if ( isset( $post['term_meta'][$key] ) ){
          $term_meta[$key] = $post['term_meta'][$key];
        } else {
          $term_meta[$key] = '';
        }
      }

      //save the option array
      update_option( "taxonomy_term_$term_id", $term_meta );
    }
  }

  public function render_options( $term ) {
    $term_meta = get_option( "taxonomy_term_$term->term_id" );
    // if ($template = locate_template('templates/shared/options_taxonomy.php')) {
      // include( $template );
    // }
  }
}

endif;
