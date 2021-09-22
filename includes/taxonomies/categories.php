<?php

class IDIIT_Category extends Taxonomy {
  public function __construct() {
    $tax = get_taxonomy( 'category' );
    $this->name = $tax->name;

    add_action( 'admin_init', array($this, 'register_options') );
    add_action( 'edit_category_form_fields', array($this, 'render_options'), 10, 2 );
    add_action( 'edit_category', array( $this, 'update_options' ), 10, 2 );
  }

  public function get_posts( $cat ) {
    return get_posts("post_type=any&posts_per_page=-1&category_name=$cat->slug");
  }
}

new IDIIT_Category();
