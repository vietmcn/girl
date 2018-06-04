<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_archive', function(){
    if ( is_tag() ) {
        global $getContent, $pageds;
        $paged = (get_query_var( 'page_tag' )) ? get_query_var( 'page_tag' ) : 1;
        $out  = '<div id="content" class="container">';
        $out .= $getContent::Content( [
            'post_type' => 'photo',
            'per_page' => '10',
            'paged' =>  $paged,
            'tag_id' => get_query_var( 'tag_id' ),
            'cat' => '',
        ] );
        $out .= '</div>';
        echo $out;
    }
} );