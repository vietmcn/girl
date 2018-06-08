<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_filter( 'girl_title', function( $att ) {

    //Title
    global $post;
    
    if ( isset( $_GET['id'] ) ) {
        if ( is_page('dw') ) {

            $post_id = $_GET['id'];
        
        } else {

            $post_id = $post->ID;

        }

    } else {
        
        if ( isset( $post->ID ) ) {
            $post_id = $post->ID;
        }
        
    }

    if ( isset( $post->ID ) ) {

        $meta = get_post_meta( $post_id, '_meta_seo', true );

    }

    if ( is_home() || is_front_page() ) {

        return ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_bloginfo('name');

    } elseif ( is_category() ) {

        return get_cat_name( get_query_var('cat') );

    } elseif ( ( is_single() && is_singular() ) || is_page('dw') ) {

        return ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_the_title( $post_id );

    } elseif ( is_tag() ) {

        $tag = get_term_by( 'id', get_query_var( 'tag_id' ), 'post_tag' );
        $site_name = explode( '//', get_bloginfo( 'url' ) );
        return $tag->name.' - '.$site_name[1];

    } else {

        return 'Page Not Found - Trangfox.com';

    }
} );

add_action( 'girl_meta', function() {

    /**
     * Meta tag
     * @since 1.0
     * @author trangfox
     */
    global $struct, $post;

    if ( isset( $_GET['id'] ) ) {

        if ( is_page('dw') ) {

            $post_id = $_GET['id'];
        
        } else {
            
            $post_id = $post->ID;

        }

    } else {

        if ( isset( $post->ID ) ) {
            $post_id = $post->ID;
        }
        
    }

    $site_name = explode( '//', get_bloginfo('url') );

    if ( isset( $post->ID ) ) {
        $meta = get_post_meta( $post_id, '_meta_seo', true );
        $meta_post = get_post_meta( $post_id, '_meta_thumbnail', true );
    }

    if ( is_home() || is_front_page() ) {

        __render( $struct->info( [
            'url' => get_bloginfo( 'url' ),
            'web_type' => 'website',
            'image' => 'https://i.imgur.com/XlLGpii.jpg',
            'title' => ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_bloginfo('name'),
            'desc' => ( !empty( $meta['meta_seo_desc'] ) ) ? $meta['meta_seo_desc'] : get_bloginfo('description'),
        ] ) );

    } elseif ( ( is_single() && is_singular() ) || is_page( 'dw' ) ) {
        
        $cat = get_the_category( $post_id );
        $tag = get_the_tags( $post_id );

        //render
        $out  = $struct->info( [
            'title' => ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_the_title( $post_id ),
            'desc' => ( !empty( $meta['meta_seo_desc'] ) ) ? $meta['meta_seo_desc'] : get_the_excerpt( $post_id ),
            'image' => ( !empty( $meta_post['meta_thumbnail'] ) ) ? $meta_post['meta_thumbnail'] : '',
            'web_type' => 'article',
            'url' => get_the_permalink( $post_id ),
        ] );
        $out .= $struct->single( [
            'cat' => $cat[0]->name,
            'tag' => $tag[0]->name,
            'public_time' => get_the_date( 'c', $post_id ),
            'author' => 'trangfox.com'
        ] );
        __render( $out );

    } elseif ( is_category() ) {


    }
    __render( $struct->default( [
        'locale' => 'en_GB',
        'fb_id' => '',
        'card' => 'summary_large_image',
        'creator' => 'trangfox.com',
        'site_name' => $site_name[1],
    ] ) );
    
});

add_action( 'wp_head', function() {
    
    global $struct, $post;

    $logo = $struct->logo( [
        'logo' => get_template_directory_uri().'/assets/img/logo.jpg',
        'url' => get_bloginfo('url'),
    ] );
    ?><script type="application/ld+json"><?php echo $logo; ?> </script><?php 

    if ( is_single() && is_singular() ) {

        $meta = get_post_meta( $post->ID, '_meta_thumbnail', true );
        $meat_post = get_post_meta( $post->ID, '_meta_seo', true );

        $bread = $struct->breadcrumb( [
            'id_1' => [
                'id' => '1',
                'name' => 'trangfox',
                'image' => 'https://i.imgur.com/XlLGpii.jpg',
            ],
            'id_2' => [
                'id' => '2',
                'name' => ( !empty( $meta_post['meta_seo_title'] ) ) ? esc_attr( $meta_post['meta_seo_title'] ) : get_the_title( $post->ID ),
                'image' => esc_url( $meta['meta_thumbnail'] ),
            ]
        ] );
        $single_post = $struct->single_post( [
            'url' => get_permalink( $post->ID ),
            'title' => ( !empty( $meta_post['meta_seo_title'] ) ) ? esc_attr( $meta_post['meta_seo_title'] ) : get_the_title( $post->ID ),
            'image' => esc_url( $meta['meta_thumbnail'] ),
            'author' => 'trangfox.com',
            'public_date' => get_the_date( 'c', $post->ID ),
            'public_date_mod' => get_the_modified_date( 'c', $post->ID ),
            'public_name' => 'tranfox.com',
            'logo' => get_template_directory_uri().'/assets/img/logo.jpg',
        ] );
        ?><script type="application/ld+json"><?php echo $bread; ?> </script><script type="application/ld+json"><?php echo $single_post; ?> </script><?php 
    }

} );