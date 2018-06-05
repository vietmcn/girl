<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_meta', function() {
    if ( is_home() || is_front_page() ) {
        global $struct, $post;
        $meta = get_post_meta( $post->ID, '_meta_seo', true );
        $site_name = explode( '//', get_bloginfo('url') );

        _render( $struct->meta( [
            'router' => 'tag',
            'content' => [
                'web_type' => 'website',
                'meta_title' => ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_bloginfo('name'),
                'site_name' => $site_name[1],
                'image' => 'https://i.imgur.com/XlLGpii.jpg',
                'fb_id' => '12233',
                'locale' => 'en_GB',
                'desc' => ( !empty( $meta['meta_seo_desc'] ) ) ? $meta['meta_seo_desc'] : get_bloginfo('description'),
                'url' => get_bloginfo('url'),
                'card' => 'summary_large_image',
                'creator' => 'trangfox.com'
                ],
            ] ) 
        );
    }
});
add_action( 'girl_meta', function() {
        
    if ( is_page('dw') ) {

        global $struct;

        if ( !empty( $_GET['id'] ) ) {
            $post_id = $_GET['id'];
        }

        $meta = get_post_meta( $post_id, '_meta_seo', true );
        $meta_post = get_post_meta( $post_id, '_meta_thumbnail', true );
        $site_name = explode( '//', get_bloginfo('url') );
        $cat = get_the_category( $post_id );
        $tag = get_the_tags( $post_id );
        _render( $struct->meta( [
            'router' => 'single',
            'content' => [
                'web_type' => 'object',
                'meta_title' => ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_bloginfo('name'),
                'site_name' => $site_name[1],
                'image' => $meta_post['meta_thumbnail'],
                'fb_id' => '12233',
                'locale' => 'en_GB',
                'desc' => ( !empty( $meta['meta_seo_desc'] ) ) ? $meta['meta_seo_desc'] : get_bloginfo('description'),
                'url' => get_bloginfo('url'),
                'card' => 'summary_large_image',
                'creator' => 'trangfox.com',
                'public_time' => get_the_date( 'c', $post_id ),
                'cat' => $cat[0]->name,
                'tag' => $tag[0]->name,
                'author' => 'trangfox.com',
                ],
            ] ) 
        );
    }
});
add_action( 'girl_archive', function(){
    if ( is_tag() ) {
        global $getContent, $pageds;
        $paged = ( get_query_var( 'page_tag' ) ) ? get_query_var( 'page_tag' ) : 1;
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