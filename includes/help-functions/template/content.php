<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '<div id="content">';
} );
add_action( 'girl_page', function() {
    /**
     * Gọi Content Trang chủ
     * @link {}
     * @since 1.0
     * @author Trangfox
     */
    global $post;
    
} );