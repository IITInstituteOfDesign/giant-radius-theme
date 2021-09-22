<?php 
/*
** Setup Custom Ajax Load More 
*/
function custom_my_load_more_scripts($qv, $max) {
  global $wp_query; 
  wp_register_script( 'ctm_loadmore', get_stylesheet_directory_uri() . '/includes/custom_myloadmore.js', array('jquery') );
  wp_localize_script( 'ctm_loadmore', 'custom_loadmore_params', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
    'posts' => json_encode( $qv ),
    'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
    'max_page' => $max
  ) );

  wp_enqueue_script( 'ctm_loadmore' );
}


function custom_loadmore_ajax_handler(){
  $args = json_decode( stripslashes( $_POST['query'] ), true );
  $args['paged'] = $_POST['page'] + 1;
  $args['post_status'] = 'publish';
  query_posts( $args );

  if( have_posts() ) :
    while( have_posts() ): the_post();

      echo '<div class="col-xl-3 col-lg-4 col-sm-6">';
      echo get_template_part('templates/card-person-2');
      echo '</div>';
      
    endwhile;
  endif;
  die;
}



add_action('wp_ajax_ctmloadmore', 'custom_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_ctmloadmore', 'custom_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
