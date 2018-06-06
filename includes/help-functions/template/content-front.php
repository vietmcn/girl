<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_meta', function() {

    global $struct, $post;

    $site_name = explode( '//', get_bloginfo('url') );
    
    if ( is_home() || is_front_page() ) {
        $meta = get_post_meta( $post->ID, '_meta_seo', true );
        __render( $struct->info( [
            'url' => get_bloginfo( 'url' ),
            'web_type' => 'website',
            'image' => '',
            'title' => ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_bloginfo('name'),
            'desc' => ( !empty( $meta['meta_seo_desc'] ) ) ? $meta['meta_seo_desc'] : get_bloginfo('description'),
        ] ) );
    }
    __render( $struct->default( [
        'locale' => 'en_GB',
        'fb_id' => '123123',
        'card' => 'summary_large_image',
        'creator' => 'trangfox.com',
        'site_name' => $site_name[1],
    ] ) );
    
});
add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '<div id="content" class="container">';
} );
add_action( 'girl_page', function() {

    if ( is_front_page() || is_home() ) {
        /**
         * Gọi Content Trang chủ
         * @link {}
         * @since 1.0
         * @author Trangfox
         */
        global $getContent, $pageds;

        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
        __render( $getContent::Content( [
            'post_type' => 'photo',
            'per_page' => '10',
            'paged' => $paged,
            'cat' => '',
            'tag_id' => '',
        ] ) ); 
    }
} );

add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );
