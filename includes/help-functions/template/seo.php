<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_meta', function() {
    
    global $post;
    
    //Gọi Structs
    $struct = new Ninja_Structured;
    if ( ! is_tag() && ! is_404() ) {
        $meta      = get_post_meta( $post->ID, '_meta_seo', true );
        $meta_post = get_post_meta( $post->ID, '_meta_thumbnail', true );
    }
    $site_name = explode( '//', get_bloginfo( 'url' ) );
    $seo = [];

    //Check Router
    if ( is_home() || is_front_page() ) {

        $seo['router'] = 'home';
        $seo['meta_title'] = $meta['meta_seo_title'];
        $seo['web_type'] = 'website';
        $seo['url'] = get_bloginfo( 'url' );
        $seo['image'] = 'https://3.bp.blogspot.com/-DuzcawRCrzw/WxFeYo589uI/AAAAAAAAH1A/pF1bHLtn0VkcsIiWhe7DICHtJ1fCkr6IACKgBGAs/s1600/0028.jpg';
        $seo['desc'] = $meta['meta_seo_desc'];
        
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

    } else {

        $seo['web_type'] = 'object';
        $seo['meta_title'] = '404';
        $seo['url'] = '';
        $seo['image'] = '';
        $seo['desc'] = '';
        
    }
    //render All Page
    $seo['router'] = 'all_page';
    $seo['site_name'] = $site_name[1];
    $seo['locale'] = 'en_GB';
    $seo['app_id'] = '';

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
                'card'         => 'summy',
                'creator'      => 'trangfox_',
                'author'       => ( !empty( $seo['author'] ) ) ? $seo['author'] : '',
                'time_public'  => ( !empty( $seo['time_public'] ) ) ? $seo['time_public'] : '',
            ],
        ] )
    );
} );

