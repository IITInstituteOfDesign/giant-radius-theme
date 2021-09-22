<?php

add_action('ninja_forms_display_css', function() {
  wp_dequeue_style('ninja-forms-display');
});

add_action('ninja_forms_display_before_field_function', function( $field_id, $data ) {
  echo '<div class="ninja-forms-field-wrap">';
}, 10, 2);

add_action('ninja_forms_display_after_field_function', function( $field_id, $data ) {
  echo '</div>';
}, 10, 2);