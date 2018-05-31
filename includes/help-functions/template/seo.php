<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_meta', function() {
    
    $struct = new Ninja_Structured;

    if ( is_front_page() || is_home() ) {
        
        $out  = $struct->title('hello');
        $out .= $struct->meta( array(
            'type' => 'facebook',
            'content' => array(
                'type' => 'website',
                'url' => get_bloginfo( 'url' ),
                'title' => 'Hello',
                'image' => '//i.imgur.com/XlLGpii.jpg',
                'desc' => '',
                'app_id' => '',
            ),
        ) );

    } elseif ( is_single() ) { 

        $out = '';

    }
    echo $out;
} );

