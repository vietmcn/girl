<?php
/**
 * Girl Template functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Girl
 * @since Girl 1.0
 */
/**
 * Defined Import Folder 
 *
 * @since 1.0
 */

if ( ! defined( 'N_EXTEND_FOLDER' ) ) {
	define( 'N_EXTEND_FOLDER', __DIR__ );
}
/**
 * Crate function import_template
 *
 * @since 1.0
 */
if ( ! function_exists( 'import_template' ) ) {
	function import_template( $name = NULL ) 
	{
		$inc = 'includes';
		$template = 'help-functions/template';
		require_once ( N_EXTEND_FOLDER .'/'.$inc.'/'.$template.'/'.$name.'.php' );
	}
}
if ( !function_exists( '__render' ) ) {
	function __render( $att = NULL )
	{
		echo $att;
	}
} 
/**
 * GET the Version Template
 *
 * @since 1.0
 */
$theme       = wp_get_theme( 'girl' );
$ver         = $theme['Version'];

/**
 * Import includes
 * @since 1.0
 */
require_once 'includes/config.php';