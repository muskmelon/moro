<?php

//-----------------------------------  // Load Scripts //-----------------------------------//

add_action('wp_enqueue_scripts', 'ok_theme_js');
function ok_theme_js() {
	if (is_admin()) return;
	
	//Register jQuery
	wp_enqueue_script('jquery');
	
	//Custom JS
	wp_enqueue_script('custom_js', get_template_directory_uri() . '/includes/js/custom/custom.js', false, false , true);
	
	//Flex
	wp_enqueue_script('flex_js', get_template_directory_uri() . '/includes/js/flex/jquery.flexslider.js', false, false , true);
	
	//Tabs
	wp_enqueue_script('tabs_js', get_template_directory_uri() . '/includes/js/tabs/jquery.tabs.min.js', false, false , true);
	
	//Fitvid
	wp_enqueue_script('fitvid_js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', false, false , true);
	
	//Mobile Menu
	wp_enqueue_script('menu_js', get_template_directory_uri() . '/includes/js/menu/jquery.mobilemenu.js', false, false , true);
	
	//Quicksand Easing
	wp_enqueue_script('easing_js', get_template_directory_uri() . '/includes/js/quicksand/jquery.easing.1.3.js', false, false , true);
	
	//Quicksand Script
	wp_enqueue_script('quicksand_js', get_template_directory_uri() . '/includes/js/quicksand/quicksand.js', false, false , true);
	
	//Quicksand Call
	wp_enqueue_script('quicksand_call_js', get_template_directory_uri() . '/includes/js/quicksand/script.js', false, false , true);
	
	//Fancybox
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/includes/js/fancybox/jquery.fancybox-1.3.4.js', false, false , true);
	
	//Twitter
	wp_enqueue_script('twitter', 'http://widgets.twimg.com/j/2/widget.js', false, false);
	
	
//-----------------------------------  // Add Extra Stylesheets //-----------------------------------//
    
    //Add Flexslider CSS
    wp_enqueue_style( 'flex_slider_css', get_template_directory_uri() . '/includes/js/flex/flexslider.css', array(), '0.1', 'screen' );
    
    //Add Fancybox CSS
    wp_enqueue_style( 'fancybox_css', get_template_directory_uri() . "/includes/js/fancybox/jquery.fancybox-1.3.4.css", array(), '0.1', 'screen' );
    
    //Deregister Fancybox in Instagram
	wp_dequeue_style( 'fancybox-css' );
}

//-----------------------------------  // Auto Feed Links //-----------------------------------//
 
add_theme_support( 'automatic-feed-links' );
function thumbnail_in_rssfeed($content) {
global $post;
if(has_post_thumbnail($post->ID)) {
$content = '<div style="float:left;">' . get_the_post_thumbnail($post->ID) . '</div>' .     $content;
}
return $content;
}
add_filter('the_excerpt_rss', 'thumbnail_in_rssfeed');
add_filter('the_content_feed', 'thumbnail_in_rssfeed');

//Custom Excerpt Limit
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}


//-----------------------------------  // Load the Widgets //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/widgets/text-column.php");
require_once(dirname(__FILE__) . "/includes/widgets/recent-photos.php");
require_once(dirname(__FILE__) . "/includes/widgets/twitter.php");
require_once(dirname(__FILE__) . "/includes/widgets/flickr.php");
require_once(dirname(__FILE__) . "/includes/widgets/dribbble.php");


//-----------------------------------  // Add Editor Styles //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/editor/add-styles.php");


//-----------------------------------  // Add Shortcodes //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/shortcodes/friendly-shortcode-buttons.php");


//-----------------------------------  // Add Menus //-----------------------------------//
add_theme_support( 'menus' );
register_nav_menu('header', 'Header Menu');
register_nav_menu('footer', 'Footer Menu');
register_nav_menu('custom', 'Custom Menu');


//-----------------------------------  // Add Featured Images //-----------------------------------//
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 150, 150, true ); // Default Thumb
add_image_size( 'portfolio-image', 296, 150, true ); // Portfolio page thumb
add_image_size( 'full-image', 940, 9999, false ); // Full fixed width image.
add_image_size( 'blog-image', 700, 9999, false ); // Blog images
add_image_size( 'home-portfolio', 188, 120, true ); // Homepage portfolio thumbs
add_image_size( 'full-size', 9999, 9999, true ); // Full width image
add_image_size( 'recent-photo', 117, 88, true ); // Recent photo widget


//-----------------------------------  // Add Background Support //-----------------------------------//

add_custom_background();


//-----------------------------------  // Add Category Class to Body //-----------------------------------//

function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = 'category-'.$category->term_id;
	return $classes;
}
add_filter('body_class', 'category_id_class');


//-----------------------------------  // Custom Comment Output //-----------------------------------//
function okay_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
		
		<div class="comment-block" id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment->comment_author_email, 35 ); ?>
					
					<div class="comment-meta commentmetadata">
						<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
						<div class="clear"></div>
						<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'okay'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','okay'),'  ','') ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="comment-text">
				<?php comment_text() ?>
				<p class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</p>
			</div>
		
			<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','okay') ?></em>
			<?php endif; ?>    
		</div>
				
		<div class="clear"></div>
<?php
}


//-----------------------------------  // Add Lightbox To Gallery Images //-----------------------------------//

//Add Lightbox to image attachments
add_filter( 'wp_get_attachment_link', 'okay_gallery_lightbox');

function okay_gallery_lightbox ($content) {
	// adds a lightbox to wp gallery images
	return str_replace("<a", "<a rel='wp-gallery-fancybox' class='fancybox'", $content);
}


//-----------------------------------  // Add Localization //-----------------------------------//

load_theme_textdomain( 'okay', TEMPLATEPATH . '/includes/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/includes/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );


//-----------------------------------  // Add Widget Areas //-----------------------------------//

if ( function_exists('register_sidebars') )

register_sidebar(array(
'name' => __('Text Boxes', 'okay'),
'description' => __('Widgets in this area will be shown as text boxes below the slider on the homepage.', 'okay'),
'before_widget' => '<div class="column-wrap"><div class="column">',
'after_widget' => '</div></div>'
));

register_sidebar(array(
'name' => __('Homepage Mid Left', 'okay'),
'description' => __('Widgets in this area will be shown on the right side of the middle of the homepage.', 'okay'),
'before_widget' => '<div class="widget">',
'after_widget' => '</div>'
));

register_sidebar(array(
'name' => __('Homepage Mid Right', 'okay'),
'description' => __('Widgets in this area will be shown on the right side of the middle of the homepage.', 'okay'),
'before_widget' => '<div class="widget">',
'after_widget' => '</div>'
));

register_sidebar(array(
'name' => __('Sidebar', 'okay'),
'description' => __('Widgets in this area will be shown on the sidebar of all pages.', 'okay'),
'before_widget' => '<div class="widget">',
'after_widget' => '</div>',
'before_title'  => '<h2>',
	'after_title'   => '</h2>'
));

register_sidebar(array(
'name' => __('Footer', 'okay'),
'description' => __('Widgets in this area will be shown own on the left side of the footer of all pages.', 'okay'),
'before_widget' => '<div class="footer-widget">',
'after_widget' => '</div>'
));

register_sidebar(array(
'name' => __('Social Page', 'okay'),
'description' => __('Widgets in this area will be shown on the Social page.', 'okay'),
'before_widget' => '<div class="social-widget">',
'after_widget' => '</div>'
));


//-----------------------------------  // Options Framework Stuff — Leave It Alone! //-----------------------------------//

okay_options_check();
function okay_options_check()
{
  if ( !function_exists('optionsframework_activation_hook') )
  {
    add_thickbox(); // Required for the plugin install dialog.
    add_action('admin_notices', 'okay_options_check_notice');
  }
}

// The Admin Notice
function okay_options_check_notice()
{
?>
  <div class='updated fade'>
    <p>The Options Framework plugin is required for this theme to function properly. <a href="<?php echo admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=589'); ?>" class="thickbox onclick">Install now</a>.</p>
  </div>
<?php
}

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

/*
* This is an example of how to override a default filter
* for 'textarea' sanitization and $allowedposttags + embed and script.
*/

add_action('admin_init','optionscheck_change_santiziation', 100);
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

//-----------------------------------  // Add Support Tab To Theme Options //-----------------------------------//

require_once(dirname(__FILE__) . "/includes/support/support.php");