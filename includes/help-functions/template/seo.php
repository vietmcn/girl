<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_meta', function() {
    
    global $post;
    //Gọi Structs
    $struct = new Ninja_Structured;

    $meta = get_post_meta( $post->ID, '_meta_seo', true );
    $site_name = explode( '//', get_bloginfo( 'url' ) );
    if ( is_category() || is_tag() ) {
        $router = 'archive';
    } elseif ( is_singular() ) {
        $meta_post = get_post_meta( $post->ID, '_meta_thumbnail', true );
        $router = 'single';
        $image = $meta_post['meta_thumbnail'];
        $web_type = 'object';
        $author = 'trangfox.com';
    } else {
        $router = '';
        $web_type = 'website';
    }
    $out = $struct->meta([
        'router' => $router,
        'content' => [
            'locale' => 'en_GB',
            'web_type' => $web_type,
            'url' => get_bloginfo( 'url' ),
            'title' => $meta['meta_seo_title'],
            'image' => $image,
            'desc' => $meta['meta_seo_desc'],
            'site_name' => $site_name[1],
            'app_id' => '123456789',
            //Twitter
            'card' => 'summy',
            'site' => $site_name[1],
            'creator' => 'trangfox_',
            'author' => $author,
            'time_public' => '',
        ],
    ]);
    echo $out;
} );

