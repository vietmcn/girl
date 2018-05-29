<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_title', function() {
    
    global $struct;
    if ( is_home() || is_front_page() ) {
        render( $struct->title( get_bloginfo('title') ) );
    }
} );