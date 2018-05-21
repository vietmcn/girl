<?php 
if ( !defined('ABSPATH') ) {
    exit;
}

add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '<div id="content" class="container">';
} );
add_action( 'girl_front', function() {
    /**
     * Gọi Content Trang chủ
     * @link {}
     * @since 1.0
     * @author Trangfox
     */
    global $post, $pageds;

    
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

    $Query = new WP_Query( array(
        'post_type' => 'photo',
        'posts_per_page' => '2',
        'orderby' => 'date',
        'paged' => $paged,
        'post_status' => 'publish',
    ) );

    $out  = '<ul id="list-thumbnail">';

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

        wp_reset_postdata();
            
    } else {

        echo 'No Thumbnail';

    }
    $out .= '</ul>';

    echo $out;

} );

add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );