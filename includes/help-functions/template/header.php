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
    echo '<div id="wallpraper" class="girl-container">';
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
    $out  = '<div id="header-cover">';
    $out .= '<figure class="cover-logo"><img src="'.get_template_directory_uri().'/assets/img/cover-avatar.jpg" alt="Sexy Girl Xiuren Photo 18+"/></figure>';
    $out .= '<'.$container.' class="bg-header bg-logo">';
    $out .= 'Trangfox.com';
    $out .= '</'.$container.'>';
    $out .= '</div>';
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
        'container' => 'nav',
        'container_class' => 'bg-menu bg-header',
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