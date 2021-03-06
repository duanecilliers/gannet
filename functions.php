<?php
/**
 * Gannet functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gannet
 */

if ( ! function_exists( 'gannet_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gannet_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Gannet, use a find and replace
	 * to change 'gannet' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gannet', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'post-thumb', 300, 200, true );
	add_image_size( 'post-thumb-lg', 780, 520, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'gannet' ),
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
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gannet_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'gannet_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gannet_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gannet_content_width', 640 );
}
add_action( 'after_setup_theme', 'gannet_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gannet_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gannet' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gannet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gannet_scripts() {
	wp_enqueue_style( 'gannet-style', get_stylesheet_uri() );

	wp_enqueue_script( 'gannet-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'gannet-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_archive() || is_home() ) {
		wp_enqueue_script( 'jquery-masonry', get_template_directory_uri() . '/js/masonry.pkgd.js', array( 'jquery' ), '4.0.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'gannet', get_template_directory_uri() . '/js/gannet.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'gannet_scripts' );

/**
 * Kirki Customizer toolkit
 */
require get_template_directory() . '/vendor/kirki/kirki.php';

/**
 * Custom utility functions
 */
require get_template_directory() . '/inc/util.php';

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
