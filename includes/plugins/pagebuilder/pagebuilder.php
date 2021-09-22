<?php
/*
** Custom Pagebuilder Layouts
*/
function regular_page__id($layouts){
	$layouts['home-page'] = array(
		'name' => __('Default Page Layout', ''),
		'description' => __('Layout for regular ID pages', ''),
		'screenshot' => get_template_directory_uri() . '/includes/plugins/pagebuilder/pagebuilder_layout_1.png',
		'filename' => get_template_directory() . '/includes/plugins/pagebuilder/pagebuilder_layout_1.json',
	);
	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts','regular_page__id');

function regular_page__id_alt($layouts){
	$layouts['home-page-alt'] = array(
		'name' => __('Default Page Layout Custom', ''),
		'description' => __('Layout with Title and Featured image Widget (Use with Full-page Clean Template)', ''),
		'screenshot' => get_template_directory_uri() . '/includes/plugins/pagebuilder/pagebuilder_layout_2.png',
		'filename' => get_template_directory() . '/includes/plugins/pagebuilder/pagebuilder_layout_2.json',
	);
	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts','regular_page__id_alt');


/*
** Add ID Custom Widget Groups
*/
function id_add_widget_tabs($tabs) {
	$tabs[] = array(
		'title' => __('ID Custom Widgets', 'id-theme'),
		'filter' => array(
			'groups' => array('id-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'id_add_widget_tabs', 20);



/*
** Hook pagebuilder editor widget
** Add checkbox that add 'box' class to the widget
*/
function custom_style_box( $form_options, $widget ){
	$a = array(
		'type' => 'checkbox',
		'default' => true,
		'label' => __( 'Add margin and white background', 'so-widgets-cbox' ),
	);

    // Lets add a new theme option
	if( !empty($form_options) ) {
		$form_options['box'] = $a;
	}

	return $form_options;
}
add_filter('siteorigin_widgets_form_options_sow-editor', 'custom_style_box', 10, 2);

function custom_style_box_template( $filename, $instance, $widget ){
    // And this one for themes
	$filename = get_stylesheet_directory() . '/includes/plugins/pagebuilder/editor/editor.php'; 
	return $filename;
}
add_filter( 'siteorigin_widgets_template_file_sow-editor', 'custom_style_box_template', 10, 3 );



// function mytheme_button_template_file( $filename, $instance, $widget ){
//     if( !empty($instance['design']['theme']) && $instance['design']['theme'] == 'test' ) {
// 		echo "<button>CUSTOM BUTTON</button>";
//     }
//     return $filename;
// }
// add_filter( 'siteorigin_widgets_template_file_sow-editor', 'mytheme_button_template_file', 10, 3 );