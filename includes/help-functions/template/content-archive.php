<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_archive', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '<div id="content" class="container">';
} );
add_action( 'girl_archive', function(){
    
    global $pageds;

    if ( is_category() ) {
        $paged = get_query_var( 'page_cat' ) ? get_query_var( 'page_cat' ) : 1;
    } elseif ( is_tag() ) {
        $paged = get_query_var( 'page_tag' ) ? get_query_var( 'page_tag' ) : 1;
    }
    $Query = new WP_Query( array(
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'paged' => $paged,
        'post_status' => 'publish',
        'cat' => get_query_var( 'cat' ) ? absint( get_query_var( 'cat' ) ) : NULL,
        'tag_id' => get_query_var( 'tag_id' ) ? absint( get_query_var( 'tag_id' ) ) : NULL,
    ) );
    ob_start();
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

        //Rest Query 
        wp_reset_postdata();
        wp_reset_query();
        
        //Paged
        $out .= $pageds::custom_paged( $Query->max_num_pages, $paged );

    } else {

        echo '<li>No Content</li>';

    }
    $out .= '</ul>';
    //Cache
    $out .= ob_get_clean();
    echo $out;
} );
add_action( 'girl_archive', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );