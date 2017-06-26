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
// https://github.com/halfempty/template-part-shortcode
// [template part="template-part-hello"] /parts/template-part-hello.php

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
