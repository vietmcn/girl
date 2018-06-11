<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( !class_exists( 'Girl_Content' ) ) {
    class Girl_Content
    {
        protected $att = array();

        public static function Content( $att )
        {
            global $pageds;
            
            $Query = new WP_Query( array(
                'post_type' => $att['post_type'],
                'posts_per_page' => $att['per_page'],
                'paged' => $att['paged'],
                'post_status' => 'publish',
                'cat' => ( !empty( $att['cat'] ) ) ? absint( $att['cat'] ) : NULL,
                'tag_id' => ( !empty( $att['tag'] ) ) ? absint( $att['tag'] ) : NULL,
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
                 $out .= $pageds::custom_paged( $Query->max_num_pages, $att['paged'] );
            } else {

                echo '<li>No Content</li>';
            }
            $out .= '</ul>';
            //Cache
            $out .= ob_get_clean();
            return $out;
        }
    }
}
$getContent = new Girl_Content;