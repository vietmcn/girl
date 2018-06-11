<?php 
if ( !defined('ABSPATH') ) {
    exit;
}

add_action( 'girl_archive', function(){

    if ( is_category() ) {

        global $getContent, $pageds;

        $paged = ( get_query_var( 'page_cat' ) ) ? get_query_var( 'page_cat' ) : 1;
        
        $out  = '<div id="content" class="container">';
        $out .= $getContent::Content( [
            'post_type' => 'photo',
            'per_page' => '10',
            'paged' =>  $paged,
            'tag_id' => '',
            'cat' => absint( get_query_var( 'cat' ) ),
        ] );
        $out .= '</div>';
        __render( $out );
    }
} );