<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_filter( 'girl_title', function( $att ) {
    global $post;
    if ( isset( $post->ID ) ) {
        $meta = get_post_meta( $post->ID, '_meta_seo', true );
    }

    if ( is_home() || is_front_page() ) {

        return ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_bloginfo('name');

    } elseif ( is_category() ) {

        return get_cat_name( get_query_var('cat') );

    } elseif ( is_single() && is_singular() ) {

        return ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_the_title( $post->ID );

    } elseif ( is_tag() ) {
        $tag = get_term_by( 'id', get_query_var( 'tag_id' ), 'post_tag' );
        $site_name = explode( '//', get_bloginfo( 'url' ) );
        return $tag->name.' - '.$site_name[1];

    } else {

        return 'Page Not Found - Trangfox.com';

    }
} );