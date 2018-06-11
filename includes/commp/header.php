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
    global $mobile;
    
    if ( $mobile->isMobile() && !$mobile->isTablet() ) {
        if ( !is_single() ) {
            $container = 'h1';
        } else {
            $container = 'div';
        }
        $out  = '<div id="header-top" class="flex">';
        $out .= '<span class="account flex"><ion-icon name="contact"></ion-icon></span>';
        $out .= '<'.$container.' class="flex logo">';
        $out .= '<a href="/" title="Home">Trangfox.com</a>';
        $out .= '</'.$container.'>';
        $out .= '<span class="search flex"><ion-icon name="search"></ion-icon></span>';
        $out .= '</div>';
    } else {
        if ( is_home() || is_front_page() ) {
            $title = 'Photo Gallery';
        } elseif ( is_category() ) {
            $title = get_cat_name( get_query_var( 'cat' ) );
        } else {
            $title = 'No';
        }
        $out  = '<div class="flex logo-desktop">';
        $out .= '<div class="left"></div>';
        $out .= '<h4 class="flex logo">';
        $out .= '<a class="flex" href="#" title="'.$title.'"><ion-icon name="aperture"></ion-icon>'.$title.'</a>';
        $out .= '</h4>';
        $out .= '<div class="flex menu-header">';
        $out .= '<a class="flex" href="/" title="Support">Help Center</a>';
        $out .= '<a class="login flex" href="#" title="Sign In"><ion-icon name="contact"></ion-icon>Sign In</a>';
        $out .= '</div>';
        $out .= '</div>';
    }
    echo $out;
} );
add_action( 'girl_header', function() {
    /**
     * Gọi Menu Header Template Girl
     * @link {https://developer.wordpress.org/reference/functions/wp_nav_menu/}
     * @since 1.0
     * @author Trangfox
     */
    global $mobile;
    if ( $mobile->isMobile() && !$mobile->isTablet() ) {
        echo wp_nav_menu( array(
            'echo' => false,
            'menu' => 'Header Menu',
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'bg-menu bg-header',
        ) );
    }
} );
add_action( 'girl_header', function() {
    /**
     * After Hedaer Container Template Girl
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );