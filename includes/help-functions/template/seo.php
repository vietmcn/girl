<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_title', function() {
    
    global $struct;
    if ( is_home() || is_front_page() ) {
        $out  = $struct->title( get_bloginfo('title') );
        $out .= $struct->meta( array( 
            'type' => 'facebook',
            'content' => array(
                'locale' => 'en_US',
                'app_id' => '',
                'type' => '',
                'url' => '',
                'title' => '',
                'image' => '',
                'image_type' => '',
                'image_url' => '',
                'desc' => '',
            ),
        ) );
        echo $out;
    }
} );