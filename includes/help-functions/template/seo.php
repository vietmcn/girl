<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_meta', function() {
    
    global $post;

    $struct = new Ninja_Structured;

    $meta = get_post_meta( $post->ID, '_meta_seo', true );

    $out = $struct->meta([
        'type' => '',
        'content' => [
            'app_id' => '123456789',
        ],
    ]);

    if ( is_front_page() || is_home() ) {
    
        //Render Title
        $out .= $struct->title( $meta['meta_seo_title'] );

        $out .= $struct->meta( [
            'type' => 'facebook',
            'content' => [
                'type' => 'website',
                'url' => get_bloginfo( 'url' ),
                'title' => $meta['meta_seo_title'],
                'image' => '//i.imgur.com/XlLGpii.jpg',
                'desc' => $meta['meta_seo_desc'],
            ],
        ] );
    } elseif ( is_category() || is_tag() ) {

    } elseif ( is_single() ) {
        
    }
    echo $out;
} );

