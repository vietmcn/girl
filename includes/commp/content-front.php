<?php
if ( !defined('ABSPATH') ) {
    exit;
}
if ( !function_exists( 'girl_swiper' ) ) {
    function girl_swiper()
    {
        return 'hello world';
    }
}
if ( !function_exists( 'girl_content' ) ) {
    function girl_content()
    {
        global $getContent, $pageds;
        return $getContent::Content( [
            'post_type' => 'photo',
            'per_page' => '10',
            'paged' =>  ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1,
            'cat' => '',
            'tag_id' => '',
        ] ); 
    }
}
add_action( 'girl_page', function() {
    if ( is_front_page() || is_home() ) {
        /**
         * Gọi Content Trang chủ
         * @link {}
         * @since 1.0
         * @author Trangfox
         */
        global $mobile;

        $out  = '<section id="content" class="container">';
        if ( $mobile->isTablet() || ! $mobile->isMobile() ) {
            $out .= ninja_filter_header();
            $out .=  girl_swiper();
        } else {
            $out .= girl_content();
        }
        $out .= '</section>';
        __render( $out );
    }
} );
