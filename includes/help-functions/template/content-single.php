<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_filter( 'meta_titles', function( $att ) {
    if ( is_single() && is_front_page() ) {
        global $post;
        $meta_post = get_post_meta( $post->ID, '_meta_thumbnail', true );
        return ( !empty( $meta_post['meta_seo_title'] ) ) ? $meta_post['meta_seo_title'] : get_the_title( $post->ID );
    }
} );
add_action( 'girl_meta', function() {
        
    if ( is_single() && is_singular() ) {

        global $struct, $post;

        $meta = get_post_meta( $post->ID, '_meta_seo', true );
        $meta_post = get_post_meta( $post->ID, '_meta_thumbnail', true );
        $site_name = explode( '//', get_bloginfo('url') );
        $cat = get_the_category( $post->ID );
        $tag = get_the_tags( $post->ID );

        //render
        $out  = $struct->info( [
            'title' => ( !empty( $meta['meta_seo_title'] ) ) ? $meta['meta_seo_title'] : get_the_title( $post->ID ),
            'desc' => ( !empty( $meta['meta_seo_desc'] ) ) ? $meta['meta_seo_desc'] : get_the_excerpt( $post->ID ),
            'image' => ( !empty( $meta_post['meta_thumbnail'] ) ) ? $meta_post['meta_thumbnail'] : '',
            'web_type' => 'article',
            'url' => get_the_permalink( $post->ID ),
        ] );
        $out .= $struct->single( [
            'cat' => $cat[0]->name,
            'tag' => $tag[0]->name,
            'public_time' => get_the_date( 'c', $post->ID ),
            'author' => 'trangfox.com'
        ] );
        __render( $out );
    }
});
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
    $out .= '<h3><ion-icon name="image"></ion-icon>Download Fill Photo</h3>';
    $out .= '<p><ion-icon name="color-fill"></ion-icon>Thank you for the light and for following our channel. It is inconvenient for us to use the shortening service to maintain the service.</p>';
    if ( ! empty( $meta['meta_download'] ) ) {
        $file = ( ! empty( $meta['meta_filesize'] ) ) ? $meta['meta_filesize'] : '';
        $out .= '<p class="pic-linkdownload"><ion-icon name="cloud-download"></ion-icon> <a rel="nofollow" tilte="'.get_the_title().'" target="_blank" href="/dw/?id='.$post->ID.'">Download Pic [ '.$meta['meta_count'].'pic ]/[ '.$file.'mb ]</a></p>';
    } else {
        
    }
    $out .= '</div>';
    echo $out;

} );
add_action( 'girl_single', function() {

    global $post;

    $cat = get_the_category( $post->ID );

    if ( !empty( $cat ) ) {

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
            $out .= '<li class="non-post">None Pic</li>';
        }
        $out .= '</ul>';
        $out .= '</aside>';
        echo $out;
    }
} );
add_action( 'girl_single', function() {
    echo '</section>';
} );