<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */

add_action( 'customize_register', function ($wp_customize) {
	class WP_Customize_Page_Template_Control extends WP_Customize_Control {
	  public $type = 'select';

	  public function render_content() {
	  	if ($template = locate_template('templates/customizer/default_template.php')) {
	  	  include( $template );
	  	}
	  }
	}

	// ==========

	$wp_customize->add_setting( 'home_carousel_image',
		 array(
				'default' => null,
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
				'sanitize_callback' => 'esc_url_raw',
		 )
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
       $wp_customize,
       'idiit-redesign_carousel_slide',
       array(
           'label'      => __( 'First carousel slide', 'theme_name' ),
           'section'    => 'static_front_page',
           'settings'   => 'home_carousel_image'
       )
     )
	);

	$wp_customize->add_setting( 'home_learn_more',
		 array(
				'default' => null,
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
		 )
	);

	// ==========

	$wp_customize->add_control(
		new WP_Customize_Control(
       $wp_customize,
       'idiit-redesign_learn_more',
       array(
           'label'      => __( 'Learn More URL', 'theme_name' ),
           'section'    => 'static_front_page',
           'settings'   => 'home_learn_more'
       )
     )
	);

	//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
});
