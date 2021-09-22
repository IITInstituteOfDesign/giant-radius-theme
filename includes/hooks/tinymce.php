<?php 



// Color Swatch Tinymce
function my_mce4_options($init) {
  $default_colours = '"000000", "Black",
  "FFFFFF", "White",
  "993300", "Burnt orange",
  "333300", "Dark olive",
  "003300", "Dark green",
  "003366", "Dark azure",
  "000080", "Navy Blue",
  "333399", "Indigo",
  "333333", "Very dark gray",
  "800000", "Maroon",
  "FF6600", "Orange",
  "808000", "Olive",
  "008000", "Green",
  "008080", "Teal",
  "0000FF", "Blue",
  "666699", "Grayish blue",
  "808080", "Gray",
  "FF0000", "Red",
  "FF9900", "Amber",
  "99CC00", "Yellow green",
  "339966", "Sea green",
  "33CCCC", "Turquoise",
  "3366FF", "Royal blue",
  "800080", "Purple",
  "999999", "Medium gray",
  "FF00FF", "Magenta",
  "FFCC00", "Gold",
  "FFFF00", "Yellow",
  "00FF00", "Lime",
  "00FFFF", "Aqua",
  "00CCFF", "Sky blue",
  "993366", "Red violet",
  "FFFFFF", "White",
  "FF99CC", "Pink",
  "FFCC99", "Peach",
  "FFFF99", "Light yellow",
  "CCFFCC", "Pale green",
  "CCFFFF", "Pale cyan",
  "99CCFF", "Light sky blue",
  "CC99FF", "Plum"
  ';

  $custom_colours =  '"394e6d", "ID Blue",
  "ffcc6c", "ID Yellow",
  "efab2b", "ID Yellow 2",
  "333243", "ID Dark Blue"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 6;

  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

// // Callback function to filter the MCE settings
// function my_mce_before_init_insert_formats( $init_array ) {  
//   // Define the style_formats array
//   $style_formats = array(  
//     // Each array child is a format with it's own settings
//     array(  
//       'title' => '.translation',  
//       'block' => 'blockquote',  
//       'classes' => 'translation',
//       'wrapper' => true,

//     ),  
//     array(  
//       'title' => '⇠.rtl',  
//       'block' => 'blockquote',  
//       'classes' => 'rtl',
//       'wrapper' => true,
//     ),
//     array(  
//       'title' => '.ltr⇢',  
//       'block' => 'blockquote',  
//       'classes' => 'ltr',
//       'wrapper' => true,
//     ),
//   );  
//   // Insert the array, JSON ENCODED, into 'style_formats'
//   $init_array['style_formats'] .= json_encode( $style_formats );  

//   return $init_array;  

// } 
// // Attach callback to 'tiny_mce_before_init' 
// add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  



// add_filter( 'tiny_mce_before_init', function ( array $settings = [] ) {

//   $formats = [];
//   if ( ! empty( $settings['style_formats'] ) && is_string( $settings['style_formats'] ) ) {
//     $formats = json_decode( $settings['style_formats'] );
//     if ( ! is_array( $formats ) ) {
//       $formats = [];
//     }
//   }

//   $formats[] = [
//     'title'  => __( '<kbd> Tag', 'some-textdomain-here' ),
//     'inline' => 'kbd',
//   ];

//   $formats[] = [
//     'title'   => __( 'Important', 'some-textdomain-here' ),
//     'block'   => 'div',
//     'classes' => 'important',
//   ];

//   $settings['style_formats'] = json_encode( $formats );

//   return $settings;
// } );






// function mce_html5_formatting( $init ) {
// //$init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';

// $style_formats =array(
//   array(
//     'title' => 'Headings',
//     'items' => array(
//       array(
//         'title' => 'Heading 1',
//         'block' => 'h1'
//       ) ,
//       array(
//         'title' => 'Heading 2',
//         'block' => 'h2'
//       ) ,
//       array(
//         'title' => 'Heading 3',
//         'block' => 'h3'
//       ) ,
//       array(
//         'title' => 'Heading 4',
//         'block' => 'h4'
//       ) ,
//       array(
//         'title' => 'Heading 5',
//         'block' => 'h5'
//       ) ,
//       array(
//         'title' => 'Heading 6',
//         'block' => 'h6'
//       )
//     )
//   ) ,
//   array(
//     'title' => 'Blocks',
//     'items' => array(
//       array(
//         'title' => 'Paragraph <p>',
//         'block' => 'p'
//       ) ,
//       array(
//         'title' => 'Arbitrary Division <div>',
//         'block' => 'div'
//       ) ,
//       array(
//         'title' => 'Preformatted Text <pre>',
//         'block' => 'pre'
//       )
//     )
//   ) ,
//   array(
//     'title' => 'Containers',
//     'items' => array(
//       array(
//         'title' => 'Section',
//         'block' => 'section',
//         'wrapper' => 'true',
//         'merge_siblings' => 'false'
//       ) ,
//       array(
//         'title' => 'Blockquote',
//         'block' => 'blockquote',
//         'wrapper' => 'true',
//         'icon' => 'blockquote'
//       ) ,
//       array(
//         'title' => 'Figure',
//         'block' => 'figure',
//         'wrapper' => 'true'
//       )
//     )
//   )
// );
// $init['style_formats'] = json_encode( $style_formats );
// $init['style_formats_merge'] = false;
// return $init;

// }
// add_filter('tiny_mce_before_init', 'mce_html5_formatting');
// //* Move the Style Select Button First
// function mce_add_buttons_styleselect( $buttons ){
//   array_splice( $buttons, 1, 0, 'styleselect' );
//   return $buttons;
// }
// add_filter( 'mce_buttons_2', 'mce_add_buttons_styleselect' );
// // */

// function myprefix_mce_buttons_1( $buttons ) {
//   array_unshift( $buttons, 'styleselect' );
//   return $buttons;
// }

// add_filter( 'mce_buttons_2', 'myprefix_mce_buttons_1' );

/**
 * Add custom styles to the mce formats dropdown
 *
 * @url https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 */
function myprefix_add_format_styles( $init_array ) {
  $style_formats = array(
    // Each array child is a format with it's own settings - add as many as you want
    array(
      'title'    => __( 'Blockquote (Dark Background)', 'text-domain' ), // Title for dropdown
      'block' => 'blockquote',
      // 'selector' => 'a', // Element to target in editor
      'classes'  => 'blockquote-2', // Class name used for CSS
      'wrapper' => 'true'
    ),
    array(
      'title'    => __( 'Blockquote (Bordered)', 'text-domain' ), // Title for dropdown
      'block' => 'blockquote',
      // 'selector' => 'a', // Element to target in editor
      'classes'  => 'blockquote-3', // Class name used for CSS
      'wrapper' => 'true'
    ),
    // array(
    //   'title'    => __( 'Highlight', 'text-domain' ), // Title for dropdown
    //   'inline'   => 'span', // Wrap a span around the selected content
    //   'classes'  => 'text-highlight' // Class name used for CSS
    // ),
  );
  $init_array['style_formats'] = json_encode( $style_formats );
  return $init_array;
} 
add_filter( 'tiny_mce_before_init', 'myprefix_add_format_styles' );

function myprefix_theme_add_editor_styles() {
  add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'myprefix_theme_add_editor_styles' );