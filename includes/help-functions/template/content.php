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
            'router' => 'home',
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
        _render( $getContent::Content( [
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
