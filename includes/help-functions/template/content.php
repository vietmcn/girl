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
add_action( 'girl_page', function() {

    if ( is_front_page() || is_home() ) {
        /**
         * Gọi Content Trang chủ
         * @link {}
         * @since 1.0
         * @author Trangfox
         */
        global $pageds;

            $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;

        $Query = new WP_Query( array(
            'post_type' => 'photo',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'paged' => $paged,
        ) );

        ob_start();
        $out  = '<ul id="list-thumbnail">';

        if ( $Query->have_posts() ) {

            while ( $Query->have_posts() ) : $Query->the_post();

                $meta = get_post_meta( $Query->post->ID, '_meta_thumbnail', true );
                
                $out .= '<li data-id="'.$Query->post->ID.'" class="thumbnail-class">';
                $out .= '<h3><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
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

            $out .= '<li class="no-content"><img src="'.get_template_directory_uri().'/assets/img/no-content.png"/></li>';

        }
        $out .= '</ul>';
        //Cache
        $out .= ob_get_clean();
        echo $out;
    }
} );

add_action( 'girl_page', function() {
    /**
     * Before Container Content Template
     * @since 1.0
     * @author Trangfox
     */
    echo '</div>';
} );
