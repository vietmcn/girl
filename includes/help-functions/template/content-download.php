<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'template_redirect', function() {
    /**
     * Create Redirect Page Download
     */
    if ( is_page( 'dw' ) ) {
        if ( empty( $_GET['id'] ) ) {
            wp_safe_redirect( home_url(), 301 );
            exit();
        }
    }
} );
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
        
    }
});
add_action( 'girl_page', function() {

    if ( is_page( 'dw' ) ) {

        if ( !empty( $_GET['id'] ) ) {
            $id = $_GET['id'];
        }
        
        if ( ! empty( $id ) ) {

            $meta = get_post_meta( esc_attr( $id ), '_meta_thumbnail', true );
            
            $out  = '<div class="download-page">';
            $out .= '<img src="'.$meta['meta_thumbnail'].'"/>';
            $out .= '<h2 id="download-title">[Download Full Photo] '.get_the_title( $id ).'</h1>';
            $out .= '<ul>';
            if ( !empty( $meta ) ) {
                $file = ( !empty( $meta['meta_filesize'] ) ) ? $meta['meta_filesize'] : '';
                $out .= '<li><ion-icon name="image"></ion-icon><span class="countpic">Pic: '.$meta['meta_count'].'</span>/<span class="filesize">'.$file.'mb</span></li>';
                $out .= '<li><ion-icon name="cloud-download"></ion-icon><span class="listdownload>">Server:</span></li>';
                $i = 1;
                if ( !empty( $meta['meta_download'] ) ) {

                    foreach ( $meta['meta_download'] as $value ) {

                        $name = explode( ']', $value );
                            
                        $sv = explode( '-', $name[0] );
                            
                        $link = $name[1];

                        if( $sv[0] == '[mega' ) {
                            $name = 'Mega.nz';
                            $part = ' Part'.$sv[1];
                        } elseif( $sv[0] == '[zippy' ) {
                            $name = 'ZippyShare';
                            $part = ' Part'.$sv[1];
                        } elseif( $sv[0] == '[mf' ) {
                            $name = 'MediaFire';
                            $part = ' Part'.$sv[1];
                        } else {
                            $name = 'Trangfox';
                            $part = '';
                        }

                        if ( count( $meta['meta_download'] ) == 1 ) {

                            $out .= '<li id="download-item"><span>'.$name.':</span> <a target="_blank" rel="nofollow" href="'.esc_url( $link ).'" title="Download photo '.get_the_title( $id ).'">'.get_the_title( $id ).'</a></li>';
    
                        } else {

                            $out .= '<li id="download-item"><span>'.$name.':</span> <a target="_blank" rel="nofollow" href="'.esc_url( $link ).'" title="Download photo '.get_the_title( $id ).'">'.get_the_title( $id ).$part.'</a></li>';
    
                        }
                    }
                }
            }
            $out .= '</div>';    
            
            echo $out;
        
        } else {
            
        }    
    }
} );
