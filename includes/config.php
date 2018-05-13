<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
/**
 * 
 * Config Template 
 * 
 * This hook is called during each page load, after the theme is initialized. 
 * It is generally used to perform basic setup, registration, and init actions for a theme.
 * 
 * @link {https://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme}
 * @since 1.0
 * 
 */
add_action( 'after_setup_theme', function() {
    /*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'girl' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	/**
	 * Reg Menu Wordpress
	 * see https://codex.wordpress.org/Function_Reference/register_nav_menu
	 */
	register_nav_menu( array(
		'main_menu' => __( 'Menu Main',      'girl' ),
	) );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
} );

/**
 * Remove Bar Admin
 * @since 1.0
 */
add_filter('show_admin_bar', '__return_false');

/**
 * import
 * @since 1.0
 */
require_once 'help-functions/req.php';