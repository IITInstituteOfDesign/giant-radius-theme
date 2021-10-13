<?php

/**
 * Includes
 *
 * The $includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$includes = array(
	'includes/config.php',
	'includes/customize.php',
	'includes/hooks/acf.php',
	'includes/hooks/adjacent_posts.php',
	'includes/hooks/excerpt.php',
	'includes/hooks/filters.php',
	'includes/hooks/ninja_forms.php',
	'includes/hooks/oembeds.php',
	'includes/hooks/templates.php',
	'includes/hooks/scripts.php',
	'includes/hooks/shortcodes.php',
	'includes/hooks/tinymce.php',

	'includes/walkers/bootstrap_navigation.php',
	'includes/walkers/category_slug_dropdown.php',
	'includes/walkers/comment.php',

	'includes/taxonomies/_base.php',
	'includes/taxonomies/categories.php',
	'includes/taxonomies/course_types.php',
	'includes/taxonomies/project_types.php',
	'includes/taxonomies/person_roles.php',
	'includes/taxonomies/tag.php',

	'includes/post_types/_base.php',
	'includes/post_types/courses.php',
	'includes/post_types/people.php',
	'includes/post_types/students.php',
	'includes/post_types/posts.php',
	'includes/post_types/projects.php',
	'includes/post_types/profile.php',

	'includes/helpers/artifact-helpers.php',
	'includes/helpers/card-helpers.php',
	'includes/helpers/course-helpers.php',
	'includes/helpers/event-helpers.php',
	'includes/helpers/filmstrip-helpers.php',
	'includes/helpers/filter-helpers.php',
	'includes/helpers/general-helpers.php',
	'includes/helpers/image-helpers.php',
	'includes/helpers/partial-helpers.php',
	'includes/helpers/person-helpers.php',
	'includes/helpers/project-helpers.php',
	'includes/helpers/tile-helpers.php',
	'includes/helpers/widget-helpers.php',
	'includes/helpers/eventbrite-helpers.php',
	'includes/helpers/ajax-helpers.php',
	'includes/helpers/video-helpers.php',

  // Widgets
	'includes/widgets/contact/widget.php',
	'includes/widgets/featured/widget.php',
	'includes/widgets/quote/widget.php',
	'includes/widgets/related/widget.php',
	'includes/widgets/twitter/widget.php',
	'includes/widgets/apply/widget.php',
	'includes/widgets/instagram/widget.php',
	'includes/widgets/featured-image-post/widget.php',
	'includes/widgets/home-box-instagram/widget.php',
	'includes/widgets/home-box-social/widget.php',
	'includes/widgets/feed-box/widget.php',
	'includes/widgets/feed-box-custom/widget.php',
	'includes/widgets/feed-box-programs/widget.php',
	'includes/widgets/feed-box-projects/widget.php',
	'includes/widgets/feed-box-events/widget.php',
	'includes/widgets/slider/widget.php',
	'includes/widgets/inline-pdf/widget.php',
	'includes/widgets/featured-link/widget.php',
	'includes/widgets/featured-post/widget.php',
	'includes/widgets/featured-person/widget.php',
	'includes/widgets/featured-page/widget.php',
	'includes/widgets/featured-event/widget.php',
	'includes/widgets/featured-person-list/widget.php',
	'includes/widgets/featured-list-item/widget.php',
	'includes/widgets/featured-list-artifact/widget.php',
	'includes/widgets/embed-video/widget.php',
	'includes/widgets/homepage-side/widget.php',
	'includes/widgets/editor-title/widget.php',
	'includes/widgets/editor-herounit/widget.php',
	'includes/widgets/courses-list/widget.php',
	'includes/widgets/archive/widget.php',
	'includes/widgets/tag/widget.php',
	'includes/widgets/homepage-quote/widget.php',
	'includes/widgets/students-list/widget.php',

	'includes/plugins/pagebuilder/pagebuilder.php',
	'includes/ajax-loadmore.php'
);

foreach ($includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);


//Hide student post types not needed in wp-admin
add_action('init', 'init_remove_support',100);
function init_remove_support()
{
	remove_post_type_support( 'student', 'editor');
	remove_post_type_support( 'student', 'excerpt');
	remove_post_type_support( 'student', 'custom-fields');
}

/*
** ACF Post Object Search
*/
function acf_post_object_custom_query( $args, $field, $post_id ) 
{
	$args['orderby'] = null;
	return $args;
}
add_filter( 'acf/fields/post_object/query', 'acf_post_object_custom_query', 10, 3 );



/*
** Function if page is child
*/
function is_page_child($pid) {// $pid = The ID of the page we're looking for pages underneath
global $post;
$anc = get_post_ancestors( $post->ID );
foreach($anc as $ancestor) {
	if(is_page() && $ancestor == $pid) {
		return true;
	}
}
if(is_page()&&(is_page($pid))){
	return true;
}else{
	return false;
}
};




/*
** Custom parameter for events single page
*/
add_action('init', function() {
	$page_id = 3518;
	$page_data = get_post( $page_id );
	if( ! is_object($page_data) ) {
		return;
	}
	add_rewrite_rule(
		$page_data->post_name . '/([^/]+)/?$',
		'index.php?pagename=' . $page_data->post_name . '&custom_event=$matches[1]',
		'top'
	);

});
add_filter('query_vars', function($vars) {
	$vars[] = "custom_event";
	return $vars;
});



/*
** ACF Custom Page
*/
add_filter('acf/settings/remove_wp_meta_box', '__return_false');
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'  => 'Site Settings',
		'menu_title'  => 'Site Settings',
		'menu_slug'   => 'site-settings',
		'capability'  => 'edit_posts',
		'redirect'    => false,
		'position'    => '63.3'
	));
}



/*
** Add STL import
*/
add_filter( 'fu_allowed_mime_types', 'my_fu_allowed_mime_types' );
function my_fu_allowed_mime_types( $mime_types ) {
	$mimes = array( 'text/plain', 'application/vnd.ms-pki.stl', 'application/x-stl'. 'application/vnd.sketchup.skp' );
	foreach( $mimes as $mime ) {
		$orig_mime = $mime;
		preg_replace("/[^0-9a-zA-Z ]/", "", $mime );
		$mime_types['application/vnd.ms-pki.stl|stl|stl_|skp|skp_|obj|obj_' . $mime ] = $orig_mime;
	}
	return $mime_types;
}



/*
** Set Featured Image for Profiles
*/
add_action( 'fu_after_upload', 'my_fu_after_upload', 10, 3 );
function my_fu_after_upload( $attachment_ids, $success, $post_id ) {
  // do something with freshly uploaded files
  // This happens on POST request, so $_POST will also be available for you
	$index = 0;
	$profileName = get_the_title($post_id);
	foreach( (array) $attachment_ids as $attachment_id ) {
		if($index==0){$att_Title = 'cv' . '-' . $profileName;}
		elseif($index==1){$att_Title = 'headshot' . '-' . $profileName; set_post_thumbnail( $post_id, $attachment_id );}
		elseif($index==2){$att_Title = 'project-image' . '-' . $profileName;}
		elseif($index==3){$att_Title = 'project-pdf' . '-' . $profileName;}
		else{$att_Title = 'other';}
  // $my_post = array(
  //   'ID'           => $attachment_id,
  //   'post_title'   => $att_Title,
  // );
  // wp_update_post( $my_post );
		$index++;
	}
}



/*
** Disable Pagination on profile pages
*/
function no_nopaging($query) {
	if (is_post_type_archive('profile')) {
		$query->set('nopaging', 1);
	}
}
add_action('parse_query', 'no_nopaging');



/*
** Read More on homepage helpers
*/
function wpdocs_excerpt_more( $more ) {
	if ( is_front_page() ){
		return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( '...', 'textdomain' )
		);
	}else{

	}
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );



/*
** Custom Length Excerpt
*/
function wpdocs_custom_excerpt_length( $length ) {
	if(is_front_page()){
		return 30;
	}else{
		return 55;
	}
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/*
** Remove Revolution Slider Metabox
*/
if ( is_admin() ) {
	function remove_revolution_slider_meta_boxes() {
		remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'project', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'course', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'person', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'profile', 'normal' );
	}
	add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );
}


/*
** Remove Append Ninja Form Metabox
*/
if ( is_admin() ) {
	add_action('add_meta_boxes', function() {
		remove_meta_box('nf_admin_metaboxes_appendaform', ['page', 'post'], 'side');
	}, 99);
}

/*
** Disable attachments / media pages
*/
function redirect_attachment_pages() {
	if ( is_attachment() ) {
		global $post;
		if ( $post && $post->post_parent ) {
			wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
			exit;
		} else {
			wp_redirect( esc_url( home_url( '/' ) ), 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'redirect_attachment_pages' );

add_action('pre_get_posts', 'alter_project_sort');
function alter_project_sort($qry) {
	if (!is_admin() && $qry->is_main_query()):
		if($qry->is_post_type_archive( 'project' ) || $qry->is_tax('project_type')) {
			$qry->set('meta_key', 'project_featured');
			$qry->set('orderby', array('meta_value' => 'DESC ', 'date' => 'DESC', 'modified' => 'DESC'));
			$qry->set('posts_per_page', 21);
		}
	endif;
	return $qry;
}

# Automatically clear autoptimizeCache if it goes beyond 256MB
if (class_exists('autoptimizeCache')) {
    $myMaxSize = 256000; 
    # You may change this value to lower like 100000 for 100MB if you have limited server space
    $statArr=autoptimizeCache::stats();
    $cacheSize=round($statArr[1]/1024);

    if ($cacheSize>$myMaxSize){
        autoptimizeCache::clearall();
        header("Refresh:0"); 
	# Refresh the page so that autoptimize can create new cache files and it does breaks the page after clearall.
    }
}

add_action( 'template_redirect', 'id_redirect_students' );

function id_redirect_students() {
	if ( is_singular( 'student' ) ) {
		wp_redirect( '/students', 301 );
		exit;
	}
}

