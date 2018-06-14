<?php
if ( !defined('ABSPATH') ) {
    exit;
}
if ( !function_exists( 'girl_content' ) ) {
    function girl_content( $att = array() )
    {
        global $getContent, $pageds;
        return $getContent::Content( [
            'post_type' => 'photo',
            'per_page' => '4',
            'paged' =>  ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1,
            'cat' => '',
            'tag_id' => '',
            'orderby_view' => $att['orderby_view'],
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

        if ( !empty( $_GET['view'] ) ) {
            $view = 'post_views';
        } else {
            $view = '';
        }
        
        $out  = '<section id="content" class="container">';
        if ( $mobile->isTablet() || ! $mobile->isMobile() ) {
            $out .= ninja_filter_header();
            $out .=  girl_content( [
                'orderby_view' => $view,
            ] );
        } else {
            $out .= girl_content();
        }
        $out .= '</section>';
        __render( $out );
    }
} );
