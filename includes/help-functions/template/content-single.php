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
       wp_enqueue_script( 'app', get_template_directory_uri().'/assets/js/app.min.js', array('jquery'), true, $ver );
    }
} );
add_action( 'girl_single', function() {
    echo '<section id="picbox">';
} );
add_action( 'girl_single', function() {

    $out  = '<h1 id="pic-title">'.get_the_title().'</h1>';
    $out .= '<div class="pic-info">';
    $out .= '<time class="pic-date" datetime="'.get_the_date('m/d/Y').'">'.get_the_date().'</time>';
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
add_action ( 'girl_single', function() {
    global $post;
    $meta = get_post_meta( $post->ID, '_meta_thumbnail', true );
    $out  = '<div class="downloadfile">';
    $out .= '<p class="file-size">'.$meta['meta_count'].'</p>';
    $out .= '<p>We use shorte link shortening service</p>';
    $out .= '</div>';
    echo $out;
} );
add_action( 'girl_single', function() {

    global $post;

    $cat = get_the_category( $post->ID );

    $Query = new WP_Query( array(
        'post_type' => 'photo',
        'orderby' => 'rand',
        'posts_per_page' => 6,
        'cat' => $cat[0]->cat_ID,
        'post__not_in' => array( $post->ID ), 
    ) );

    $out  = '<aside class="related">';
    $out .= '<div class="title">Related</div>';
    $out .= '<ul id="list-thumbnail">';
    if ( $Query->have_posts() ) {

        while ( $Query->have_posts() ) : $Query->the_post();

            $meta = get_post_meta( $Query->post->ID, '_meta_thumbnail', true );

            $out .= '<li data-id="'.$Query->post->ID.'" class="thumbnail-class">';
            $out .= '<h2><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>';
            $out .= '<figure><a href="'.get_permalink().'" title="'.get_the_title().'">';
            $out .= '<img class="thumbnail-item" src="'.$meta['meta_thumbnail'].'" alt="'.get_the_title().'" />';
            $out .= '</a></figure>';
            $out .= '<div class="meta flex">';
            $out .= '<span class="count">'.$meta['meta_count'].'pic</span>';
            $out .= '<span>'.get_the_date().'</span>';
            $out .= '</div>';
            $out .= '</li>';

        endwhile;

    } else {
        
    }
    $out .= '</ul>';
    $out .= '</aside>';
    echo $out;
} );
add_action( 'girl_single', function() {
    echo '</section>';
} );