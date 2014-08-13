<?php
/**
 * birds functions and definitions
 *
 * @package birds
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'birds_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function birds_setup() {
	load_theme_textdomain( 'birds', get_template_directory() . '/languages' );

  add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(125, 125, true);   // default thumb size

  add_image_size( 'birds-thumb-sm', 50, 50, true );
	add_image_size( 'birds-thumb', 150, 150, true );
	add_image_size( 'birds-thumb-portfolio', 300, 300, true );
  add_image_size( 'birds-sm', 640, 400, true );
	add_image_size( 'birds-md', 760, 9999, false );
	add_image_size( 'birds-lg', 1200, 9999, false );

	// This theme uses wp_nav_menu() in one location.
	add_theme_support( 'menus' );
	register_nav_menus( array(
		'main_nav' => __( 'The Main Menu', 'birds' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'birds_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // birds_setup
add_action( 'after_setup_theme', 'birds_setup' );

/* ============================================================================
  Main Menu
=============================================================================*/
function birds_main_nav() {
  wp_nav_menu(
  	array(
  		'menu' => 'main_nav', /* menu name */
  		'menu_class' => 'nav navbar-nav',
  		'theme_location' => 'main_nav' /* where in the theme it's assigned */
  	)
  );
}
// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );

function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  return $classes;
}
/* ============================================================================
  * Register widgetized area and update sidebar with default widgets.
=============================================================================*/
function birds_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'birds' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
  register_sidebar( array(
    'name'          => __( 'about-sidebar', 'birds' ),
    'id'            => 'sidebar-2',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
}
add_action( 'widgets_init', 'birds_widgets_init' );

/* ============================================================================
  Cleaning up the Wordpress Head
  https://gist.github.com/scottlyttle/4701366
=============================================================================*/
function removeHeadLinks() {
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
  remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
  remove_action( 'wp_head', 'index_rel_link' ); // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
  remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

/**
 * Automatically move JavaScript code to page footer, speeding up page loading time.
 */
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);

/* ============================================================================
 * Enqueue scripts and styles.
=============================================================================*/
function birds_scripts() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/app.min.css', array(), '1.0', 'all' );
  wp_enqueue_style( 'bootstrap' );

	wp_enqueue_style( 'birds-style', get_stylesheet_uri() );

	wp_register_script( 'bootstrap',
    get_template_directory_uri() . '/assets/js/bootstrap.min.js',
    array('jquery'),
    '1.2' );
  wp_enqueue_script('bootstrap');

	wp_enqueue_script( 'birds-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'birds_scripts' );

/* ============================================================================
 * Custom function to add a class to edit_post_link()
=============================================================================*/
//Add class to edit button
function custom_edit_post_link($output) {
 $output = str_replace('class="post-edit-link"', 'class="btn btn-primary btn-xs"', $output);
 return $output;
}
add_filter('edit_post_link', 'custom_edit_post_link');

/* ============================================================================
 * Bootstrap WordPress Pagination Using WP-Pagenavi
 * http://calebserna.com/bootstrap-wordpress-pagination-wp-pagenavi/
=============================================================================*/
//attach our function to the wp_pagenavi filter
add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );

//customize the PageNavi HTML before it is output
function ik_pagination($html) {
  $out = '';

  //wrap a's and span's in li's
  $out = str_replace("<div","",$html);
  $out = str_replace("class='wp-pagenavi'>","",$out);
  $out = str_replace("<a","<li><a",$out);
  $out = str_replace("</a>","</a></li>",$out);
  $out = str_replace("<span","<li><span",$out);
  $out = str_replace("</span>","</span></li>",$out);
  $out = str_replace("</div>","",$out);

  return '<ul class="pagination pagination-lg">'.$out.'</ul>';
}

/* ============================================================================
 * Includes
=============================================================================*/
// Bird List Post Type Functions
require get_template_directory() . '/inc/bird-post.php';
// Portfolio Post Type Functions
require get_template_directory() . '/inc/portfolio-post.php';
// Custom Widgets.
require get_template_directory() . '/inc/custom-widgets.php';

// _s includes
// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';
// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';
// Customizer additions.
require get_template_directory() . '/inc/customizer.php';
// Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';
