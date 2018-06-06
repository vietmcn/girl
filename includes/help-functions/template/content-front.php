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
    echo '<div id="content" class="container">';
} );
add_action( 'girl_page', function() {

    if ( is_front_page() || is_home() ) {
        /**
         * Gọi Content Trang chủ
         * @link {}
         * @since 1.0
         * @author Trangfox
         */
        global $getContent, $pageds;
        
        __render( $getContent::Content( [
            'post_type' => 'photo',
            'per_page' => '10',
            'paged' =>  ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1,
            'cat' => '',
            'tag_id' => '',
        ] ) ); 
    }
} );

add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );
