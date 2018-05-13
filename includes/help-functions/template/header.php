<?php
/**
 * Create Template Header 
 * @since 1.0
 * @author Trangfox
 * 
 */
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_header', function() {
   /**
    * Before Header Container Template Girl
    * @since 1.0
    * @author Trangfox
    */
    echo '<div id="wallpraper" class="girl-container flex">';
} );
add_action( 'girl_header', function() {
    /**
     * Gọi Logo Template
     * @link {}
     * @since 1.0
     * @author Trangfox
     */
    if ( ! is_single() ) {
        $container = 'h1';
    } else {
        $container = 'div';
    }
    $out = '<'.$container.' class="">';
    $out .= 'Trangfox.com';
    $out .= '</'.$container.'>';
    echo $out;
} );
add_action( 'girl_header', function() {
    /**
     * Gọi Menu Header Template Girl
     * @link {https://developer.wordpress.org/reference/functions/wp_nav_menu/}
     * @since 1.0
     * @author Trangfox
     */
    $out = wp_nav_menu( array(
        'echo' => false,
        'menu' => 'Header Menu',
        'theme_location' => 'primary',
        'container' => 'nav'
    ) );
    echo $out;
} );
add_action( 'girl_header', function() {
    /**
     * After Hedaer Container Template Girl
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );