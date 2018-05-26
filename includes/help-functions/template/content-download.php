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
add_action( 'girl_page', function() {

    if ( is_page( 'dw' ) ) {

        if ( !empty( $_GET['id'] ) ) {
            $id = $_GET['id'];
        }
        
        if ( ! empty( $id ) ) {
            $meta = get_post_meta( esc_attr( $id ), '_meta_thumbnail', true );

            $out  = '<div class="download-page">';
            $out .= '<h2 id="download-title">[Download Full Photo] '.get_the_title( $id ).'</h1>';
            $out .= '<ul>';
            $out .= '<li><span class="countpic">Pic: '.$meta['meta_count'].'</span>/<span class="filesize">'.$meta['meta_filesize'].'mb</span></li>';
            $out .= '<li><span class="listdownload>">Server:</span></li>';
            if ( !empty( $meta ) ) {
                $i = 1;
                foreach ( $meta['meta_download'] as $value ) {

                    if ( count( $meta['meta_download'] ) == 1 ) {

                        $out .= '<li id="download-item"><a target="_blank" rel="nofollow" href="'.esc_url( $value ).'" title="Download photo '.get_the_title( $id ).'">'.get_the_title( $id ).'</a></li>';

                    } else {
                        $name = explode( '-', $value );
                        $link = $name[1];
                        if( $name[0] == 'mega' ) {
                            $name = 'mega';
                        } elseif( $name[0] == 'zippy' ) {
                            $name = 'ZippyShare';
                        } elseif( $name[0] == 'mf' ) {
                            $name = 'MegaFire';
                        } else {
                            $name = 'Trangfox';
                        }
                        $out .= '<li id="download-item"><span>'.$name.':</span> <a target="_blank" rel="nofollow" href="'.esc_url( $link ).'" title="Download photo '.get_the_title( $id ).'">'.get_the_title( $id ).$i++.'</a></li>';
                       
                        
                    }
                }
            }
            $out .= '</div>';    
            
            echo $out;
        
        } else {
            
        }    
    }
} );
