<?php 
  // Extends SiteOrigin Embedded Video Widget
class MyCustomWidget extends SiteOrigin_Widget {
    // We're leaving out all the setup code here

    function modify_form( $form ) {
        // We can modify this $form array however we want
        $form['test_field'] = array(
            'type' => 'text',
            'label' => __('Test Field', 'my-theme'),
        );
        return $form;
    }
}