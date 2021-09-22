<?php

class IDIIT_Post extends PostType {
  public function __construct() {
    $this->singular = 'Post';
    $this->name = strtolower($this->singular);
    $this->plural = 'Posts';
    // $this->options_base = "idiit_$this->name";

    // add_action( 'admin_init', array($this, 'register_options') );
    // add_action( 'admin_init', array($this, 'update_options') );
    // add_action( 'admin_menu', array($this, 'options_menu') );
    // add_action( 'admin_notices', array($this, 'admin_notices') );
  }

  // public function options_menu() {
  //   add_submenu_page(
  //     "edit.php",
  //     "$this->singular Options",
  //     'Options',
  //     'manage_options',
  //     sprintf('%s_options', $this->name),
  //     array($this, 'render_options')
  //   );
  // }
}

new IDIIT_Post();
