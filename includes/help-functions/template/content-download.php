<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'template_redirect', 'my_callback' );
function my_callback() {
  if ( is_page( 'dw' ) ) {
      if ( ! isset( $_GET['id'] ) ) {
          wp_redirect( "/", 301 );
          exit();
        }
    }
}
add_action( 'girl_page', function() {

    if ( is_page( 'dw' ) ) {

        if ( !empty( $_GET['id'] ) ) {
            $id = $_GET['id'];
        }
        
        if ( ! empty( $id ) ) {
            $meta = get_post_meta( esc_attr( $id ), '_meta_thumbnail', true );

            $out  = '<div class="download-page">';
            $out .= '<h1 id="download-title">Download Full Photo '.get_the_title( $id ).'</h1>';
            $out .= '<ul>';
            if ( !empty( $meta ) ) {
                $i = 1;
                foreach ( $meta['meta_download'] as $value ) {

                    if ( count( $meta['meta_download'] ) == 1 ) {

                        $out .= '<li id="download-item"><a href="'.esc_url( $value ).'" title="Download photo '.get_the_title( $id ).'">'.get_the_title( $id ).'</a></li>';

                    } else {

                        $out .= '<li id="download-item"><a href="'.esc_url( $value ).'" title="Download photo '.get_the_title( $id ).'">'.get_the_title( $id ).$i++.'</a></li>';
                        
                    }
                }
            }
            $out .= '</div>';    
            
            echo $out;
        
        } else {
            
        }    
    }
} );
