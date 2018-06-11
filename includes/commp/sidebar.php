<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( !function_exists( 'ninja_sidebar_logo' ) ) {
    function ninja_sidebar_logo( $post_id = NULL )
    {
        if ( !is_single() ) {
            $h = 'h1';
        } else {
            $h = 'h3';
        }
        $meta = get_post_meta( $post_id, '_meta_seo', true );
        if ( isset( $meta['meta_seo_title'] )  ) {
            $title = esc_attr( $meta['meta_seo_title'] );
        } else {
            $title = get_bloginfo( 'name' );
        }
        $out  = '<'.$h.' class="sidebar-logo flex">';
        $out .= '<a href="'.get_bloginfo( 'url' ).'" title="'.$title.'">Trangfox<ion-icon name="add"></ion-icon></a>';
        $out .= '</'.$h.'>';
        return $out;
    }
}
if ( !function_exists( 'ninja_sidebar_nav' ) ) {
    function ninja_sidebar_nav()
    {
        $out  = '<div class="sidebar-menu">';
        $out .= '<ul>';
        $out .= '<li class="browse"><a class="active flex" href="/"><ion-icon name="globe"></ion-icon>Browse</a></li>';
        $out .= '<li class="browse"><a class="flex" href="#"><ion-icon name="stopwatch"></ion-icon>History</a></li>';
        $out .= '<li class="browse"><a class="flex" href="#"><ion-icon name="list-box"></ion-icon>Wishlist</a></li>';
        $out .= '</ul>';
        $out .= '</div>';
        return $out;
    }
}
if ( !function_exists( 'ninja_sidebar_cat' ) ) {
    function ninja_sidebar_cat()
    {
        $cat = get_categories();

        $out  = '<div class="sidebar-cat">';
        $out .= '<ul>';
        foreach ($cat as $cats ) {
            $out .= '<li class="item-cat cat-'.$cats->slug.'"><a href="'.esc_url( get_category_link( $cats->term_id ) ).'" title="'.get_cat_name( $cats->term_id ).'">'.$cats->name.'</a></li>';
        }
        $out .= '</ul>';
        $out .= '</div>';
        return $out;
    }
}
add_action( 'girl_page',    'ninja_sidebar' );
add_action( 'girl_archive', 'ninja_sidebar' );
if ( !function_exists( 'ninja_sidebar' ) ) {
    function ninja_sidebar() 
    {
        global $post, $mobile;
    
        if ( $mobile->isTablet() || ! $mobile->isMobile() ) {
            $out  = '<aside ninja-sidebar data-wallpaper="hero-profile">';
            $out .= ninja_sidebar_logo( $post->ID );
            $out .= '<span class="sidebar-border"></span>';
            $out .= ninja_sidebar_nav();
            $out .= '<span class="sidebar-border"></span>';
            $out .= ninja_sidebar_cat();
            $out .= '</aside>';
            __render( $out );
        }
    }
}