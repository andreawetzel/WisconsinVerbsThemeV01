<?php

//Show template name -- comment out when not in use

/* 
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r('<small><b>Template Page:</b> '.$template.'</small>');
}*/




//Load CSS
function wv_theme_styles() {
    wp_enqueue_style('verbs-styles', get_template_directory_uri() . '/css/main.css' );
}

add_action('wp_enqueue_scripts', 'wv_theme_styles');


//Load Site Scripts

function wv_theme_js(){
    wp_enqueue_script('modernizer_js', get_template_directory_uri() . '/js/modernizr.js', '', '', false );
    wp_enqueue_script('wiverb_js', get_template_directory_uri() . '/js/wiverb.js', array('jquery'), '', true );
}

add_action('wp_enqueue_scripts', 'wv_theme_js');


//Support Featured Images in this Theme
add_theme_support( 'post-thumbnails' );


//Remove elipsis after excerpt
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Remove lame emoji injection in header
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


// Create a custom menus
function register_my_menus() {
  register_nav_menus(
    array(
      'nav-nav' => __( 'Main Site Navigation' ) //could add more menus to array if desired
    )
  );
}
add_action( 'init', 'register_my_menus' );



//Remove image widths and heights

	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

//Remove attached image sizes as well (Downside: Also removes embedded video sizing)
	add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
	function remove_thumbnail_dimensions( $html ) {
    		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    		return $html;
	}

//Also remove image widths from captions

add_shortcode( 'wp_caption', 'fixed_img_caption_shortcode' );
add_shortcode( 'caption', 'fixed_img_caption_shortcode' );

function fixed_img_caption_shortcode($attr, $content = null) {
	 if ( ! isset( $attr['caption'] ) ) {
		 if ( preg_match( '#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches ) ) {
		 $content = $matches[1];
		 $attr['caption'] = trim( $matches[2] );
		 }
	 }
	 $output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
		 if ( $output != '' )
		 return $output;
	 extract( shortcode_atts(array(
	 'id'      => '',
	 'align'   => 'alignnone',
	 'width'   => '',
	 'caption' => ''
	 ), $attr));
	 if ( 1 > (int) $width || empty($caption) )
	 return $content;
	 if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	 return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
	 . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}


//Create widget function
function wv_create_widget($name, $id, $description) {
    register_sidebar(array(
        'name' => __($name),
        'id' => $id,
        'description' => __($description),
        'before_widget' => '<div class="'.$id.'">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

//Create a new widget
wv_create_widget("Side Widget 1", "side-widget-1", "Sidebar content");

//Create more widgets
wv_create_widget("Footer Widget 1", "footer-widget-1", "Footer content");
wv_create_widget("Footer Widget 2", "footer-widget-2", "Footer content");
wv_create_widget("Footer Widget 3", "footer-widget-3", "Footer content");
wv_create_widget("Instagram Widget", "instagram-widget", "Instagram content");


//Max content width to enlarge images in posts
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

//Remove Media / Image Gallery style injection
add_filter( 'use_default_gallery_style', '__return_false' );

//Custom comment list
function wv_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p>Pingback <?php comment_author(); ?> <span class="edit-link"><?php edit_comment_link(); ?></span></p>
	<?php
		break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<div <?php comment_class(); ?> id="box-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-article">
			<header class="comment-meta comment-author">
				<div class="fn"><?php comment_author(); ?></div>
				<div class="comment-meta commentmetadata"><a href="<?php comments_link(); ?>"><?php comment_date(); ?> <?php comment_time(); ?> </a></div>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<span class="edit-link"><?php edit_comment_link(); ?></span>
			</section>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => ('Reply'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>
	<?php
		break;
	endswitch;
}

// Add support for template part shortcodes  
// Thanks to https://github.com/halfempty/template-part-shortcode
// Example: [template part="template-part-hello"] => /parts/template-part-hello.php

function template_part_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'part' => '',
	), $atts ) );
	$file = locate_template('parts/' . $part . '.php');
    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;
}
add_shortcode( 'template', 'template_part_shortcode' );


// Custom Post Types  
// These could be moved to a Plugin

if(!function_exists('wiverb_post_types')) {
  /**
   * Adds custom post types and taxonomies
   */
  function wiverb_post_types() {
    global $wp_rewrite;

    /*
    * Hiking Trail listing 
    */
    register_post_type( 'wiverb_hike',
      array(
        'labels' => array(
          'name' => __( 'Hiking Trails' ),
          'singular_name' => __( 'Hiking Trail' ),
          'add_new_item' => __('Add New Trail'),
          'edit_item' => __('Edit Trail'),
          'new_item' => __('New trail'),
          'view_item' => __('View trail'),
          'search_items' => __('Search trails'),
          'not_found' => __('No trails were found'),
          'not_found_in_trash' => ('No trails found in trash')
        ),
        'public' => true,
        'show_in_menu' => false,
        'exclude_from_search' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        'rewrite' => array( 'slug' => 'trails/hiking' ),
        'has_archive' => 'trails/hiking'
      )
    );
    
    /*
    * Biking Trail listing 
    */
    register_post_type( 'wiverb_bike',
      array(
        'labels' => array(
          'name' => __( 'Biking Trails' ),
          'singular_name' => __( 'Biking Trail' ),
          'add_new_item' => __('Add New Trail'),
          'edit_item' => __('Edit Trail'),
          'new_item' => __('New trail'),
          'view_item' => __('View trail'),
          'search_items' => __('Search trails'),
          'not_found' => __('No trails were found'),
          'not_found_in_trash' => ('No trails found in trash')
        ),
        'public' => true,
        'show_in_menu' => false,
        'exclude_from_search' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        'rewrite' => array( 'slug' => 'trails/biking' ),
        'has_archive' => 'trails/biking'
      )
    );  
  }
  add_action( 'init', 'wiverb_post_types' );
}


/*
* Admin Controls
*/

if(!function_exists('wiverbs_trails_menu')) {
  /**
   * Adds admin nav & subnav
   */
  function wiverbs_trails_menu() {
    add_menu_page( 'Trails', 'Trails', 'edit_posts', 'wiverbs_trails', 'wiverbs_trails_page', 'dashicons-location-alt', 5 );
    
    add_submenu_page('wiverbs_trails', 'Hiking Trails', 'Hiking Trails', 'edit_posts', 'edit.php?post_type=wiverb_hike');
    
    add_submenu_page('wiverbs_trails', 'Biking Trails', 'Biking Trails', 'edit_posts', 'edit.php?post_type=wiverb_bike');
  }
  add_action( 'admin_menu', 'wiverbs_trails_menu' );
}

if(!function_exists('wiverbs_trails_page')) {
  /**
   * Add content to the admin trails top-level page
   */
  function wiverbs_trails_page() {
    if ( !current_user_can( 'edit_posts' ) )  {
      wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
    echo '<h2>Trails</h2><p>Edit trails by selecting from the list below';
    echo '<ul>'; 
    echo '<li><a href="'. home_url() .'/wp-admin/edit.php?post_type=wiverb_hike">Hiking Trails</a></li>';
    echo '<li><a href="'. home_url() .'/wp-admin/edit.php?post_type=wiverb_bike">Biking Trails</a></li>';
    echo '</ul>';
    echo '</div>';
  }
}
