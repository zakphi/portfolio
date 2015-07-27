<?php
/**
 * portfolio functions and definitions
 *
 * @package portfolio
 */

if ( ! function_exists( 'portfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function portfolio_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'portfolio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'portfolio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // portfolio_setup
add_action( 'after_setup_theme', 'portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'portfolio_content_width', 640 );
}
add_action( 'after_setup_theme', 'portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function portfolio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'portfolio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function portfolio_scripts() {
	wp_enqueue_style( 'portfolio-style', get_stylesheet_uri() );

	wp_enqueue_script( 'portfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'portfolio-min', get_template_directory_uri().'/js/min.js', array('jquery'), '20150727', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'portfolio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function create_work_posttype()
{
  $labels = array(
    'name'               => __( 'Work' ),
    'singular_name'      => __( 'Work' ),
    'add_new'            => __( 'Add New' ),
    'add_new_item'       => __( 'Add New Work' ),
    'edit_item'          => __( 'Edit Work' ),
    'new_item'           => __( 'New Work' ),
    'all_items'          => __( 'All Work' ),
    'view_item'          => __( 'View Work' ),
    'search_items'       => __( 'Search Work' ),
    'not_found'          => __( 'No work found' ),
    'not_found_in_trash' => __( 'No work found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Work'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'My Work',
    'public'        => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
    'has_archive'   => false
  );
  register_post_type( 'work', $args);
}
add_action( 'init', 'create_work_posttype' );

/**
 * Get the bootstrap!
 */
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/CMB2/init.php';
}

add_action( 'cmb2_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = 'work_';

  /**
   * Initiate the metabox
   */
  $cmb_work = new_cmb2_box( array(
    'id'            => 'work_info',
    'title'         => __( 'Work Info', 'cmb2' ),
    'object_types'  => array( 'work', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
  ) );

  // Regular text field
  $cmb_work->add_field( array(
    'name'       => __( 'Description', 'cmb2' ),
    'id'         => $prefix . 'desc',
    'type'       => 'textarea_small',
  ) );

  // URL text field
  $cmb_work->add_field( array(
    'name' => __( 'URL', 'cmb2' ),
    'id'   => $prefix . 'url',
    'type' => 'text_url',
    'protocols' => array('http', 'https'), // Array of allowed protocol
  ) );

	$cmb_about = new_cmb2_box( array(
  	'id'            => 'my_info',
    'title'         => __( 'My Info', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
		'show_on'				=> array( 'id' => 12 ),
  ) );

	$cmb_about->add_field( array(
		'name'		=>	'Resume',
		'id'			=>	$prefix . 'resume',
		'type'		=>	'file',
		'options' =>	array(
			'url' => false,
		),
	) );
}

require get_template_directory() . '/inc/admin-options.php';
