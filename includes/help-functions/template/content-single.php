<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'wp_enqueue_scripts', function() {
    /**
     * Get Photo 
     * @since 1.0
     * @author Girl
     */
    global $ver;
    if ( is_single() ) {
       wp_enqueue_script( 'app', get_template_directory_uri().'/assets/js/app.js', array('jquery'), true, $ver );
    }
} );
add_action( 'girl_single', function() {
    echo '<section id="picbox">';
} );
add_action( 'girl_single', function() {

    $out  = '<h1 id="pic-title">'.get_the_title().'</h1>';
    $out .= '<div class="pic-info">';
    $out .= '<time class="pic-date" datetime="">'.get_the_date().'</time>';
    $out .= '</div>';
    echo $out;

} );
add_action( 'girl_single', function() {
    global $post;
    $out_post = get_post( esc_attr( $post->ID ) );
    $out = $out_post->post_content;
    $out = apply_filters( 'the_content', $out );
    $out = str_replace( ']]>', ']]&gt;', $out );
    echo $out;
} );
add_action( 'girl_single', function() {
    echo '</section>';
} );