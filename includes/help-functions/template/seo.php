<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_meta', function() {
    
    global $post;
    
    //Gọi Structs
    $struct = new Ninja_Structured;
    if ( ! is_tag() && ! is_404() ) {
        $meta_seo  = get_post_meta( $post->ID, '_meta_seo', true );
        $meta_post = get_post_meta( $post->ID, '_meta_thumbnail', true );
    }
    $site_name = explode( '//', get_bloginfo( 'url' ) );
    $seo = [];

    //Check Router
    if ( is_home() || is_front_page() ) {

        $seo['router'] = 'home';
        $seo['meta_title'] = ( !empty( $meta_seo['meta_seo_title'] ) ) ? $meta_seo['meta_seo_title'] : get_bloginfo('name');
        $seo['web_type'] = 'website';
        $seo['url'] = get_bloginfo( 'url' );
        $seo['image'] = '//i.imgur.com/P8ft42T.jpg';
        $seo['desc'] = ( !empty( $meta_seo['meta_seo_desc'] ) ) ? $meta_seo['meta_seo_desc'] : get_bloginfo('description');
        
    } elseif ( is_category() ) {
        
        $cat_id = absint( get_query_var('cat') );
        
        $seo['web_type'] = 'object';
        $seo['meta_title'] = get_cat_name( $cat_id );
        $seo['url'] = get_category_link( $cat_id );
        $seo['image'] = '';
        $seo['desc'] = '';

    } elseif ( is_tag() ) {

        $tag_id = absint( get_query_var('tag_id') );
        $tag = get_term_by( 'id', $tag_id, 'post_tag' );
        
        $seo['web_type'] = 'object';
        $seo['meta_title'] = $tag->name;
        $seo['url'] = get_tag_link( $tag_id );
        $seo['image'] = '';
        $seo['desc'] = '';

    } elseif ( is_single() || is_singular() ) {

        $cat = get_the_category( $post->ID );
        $tag = get_the_tags( $post->ID );
        $seo['router'] = 'single';
        $seo['web_type'] = 'article';
        $seo['meta_title'] = ( !empty( $meta_seo['meta_seo_title'] ) ) ? $meta_seo['meta_seo_title'] : get_the_title( $post->ID );
        $seo['url'] = get_permalink( $post->ID );
        $seo['image'] = ( !empty( $meta_post['meta_thumbnail'] ) ) ? $meta_post['meta_thumbnail'] : '';
        $seo['desc'] = ( !empty( $meta_seo['meta_seo_desc'] ) ) ? $meta_seo['meta_seo_desc'] : get_the_excerpt( $post->ID );
        $seo['cat'] = $cat[0]->name;
        $seo['tag'] = $tag[0]->name;
        $seo['author'] = 'trangfox.com';
        $seo['public_time'] = get_the_date( 'c', $post->ID );

    } else {

        $seo['web_type'] = 'object';
        $seo['meta_title'] = 'Paged Not Found - Trangfox.Com';
        $seo['url'] = get_bloginfo('url');
        $seo['image'] = '//i.imgur.com/P8ft42T.jpg';
        $seo['desc'] = 'Oop!! I did not find the page you were looking.';
        
    }
    //render All Page
    $seo['site_name'] = $site_name[1];
    $seo['locale'] = 'en_GB';
    $seo['app_id'] = '1234565';

    _render( $struct->meta( [
            'router' => ( !empty( $seo['router'] ) ) ? $seo['router'] : '',
            'content' => [
                'locale'       => $seo['locale'],
                'meta_title'   => $seo['meta_title'],
                'web_type'     => $seo['web_type'],
                'url'          => $seo['url'],
                'meta_title'   => $seo['meta_title'],
                'image'        => $seo['image'],
                'desc'         => $seo['desc'],
                'site_name'    => $seo['site_name'],
                //Facebook
                'app_id'       => $seo['app_id'],
                //Twitter
                'card'         => 'summary_large_image',
                'creator'      => 'trangfox_',
                'cat'          => ( !empty( $seo['cat'] ) ) ? $seo['cat'] : '',
                'tag'          => ( !empty( $seo['tag'] ) ) ? $seo['tag'] : '',
                'author'       => ( !empty( $seo['author'] ) ) ? $seo['author'] : '',
                'public_time'  => ( !empty( $seo['public_time'] ) ) ? $seo['public_time'] : '',
            ],
        ] )
    );
} );

