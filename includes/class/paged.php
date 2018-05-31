<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;

add_action( 'pre_get_posts', function( $query ) {
    /**
    * Set Pre Post
    * @link {}
    * @since 1.0
    * @author Girl 
    */
    if ( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_category() ) {

        $query->set('page_cat', get_query_var('paged'));

        $query->set( 'paged', 0 );

    } elseif ( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_tag() ) {

        $query->set( 'page_tag', get_query_var('paged') );

        $query->set( 'paged', 0 );

    }
} );

if ( ! class_exists( 'App_paged' ) ) :

    class App_paged
    {
        public static function custom_paged( $numpages = '', $paged = '' )
        {
            
            global $wp_rewrite;
            
            // Setting up default values based on the current URL.
            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $url_parts    = explode( '?', $pagenum_link );
        
            // Get max pages and current page out of the current query, if available.
            $total   = $numpages;
            $current = $paged;
        
            // Append the format placeholder to the base URL.
            $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';
        
            // URL base depends on permalink settings.
            $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
            $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
            $defaults = array(
                'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
                'format'             => $format, // ?page=%#% : %#% is replaced by the page number
                'total'              => $total,
                'current'            => $current,
                'aria_current'       => 'page',
                'show_all'           => false,
                'prev_next'          => true,
                'prev_text'          => __( 'Previous' ),
                'next_text'          => __( 'Next' ),
                'end_size'           => 1,
                'mid_size'           => 2,
                'type'               => 'plain',
                'add_args'           => array(), // array of query args to add
                'add_fragment'       => '',
                'before_page_number' => '',
                'after_page_number'  => '',
            );
         
            $args = wp_parse_args( $defaults );

            if ( ! is_array( $args['add_args'] ) ) {
                $args['add_args'] = array();
            }
            // Merge additional query vars found in the original URL into 'add_args' array.
            if ( isset( $url_parts[1] ) ) {
                // Find the format argument.
                $format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
                $format_query = isset( $format[1] ) ? $format[1] : '';
                wp_parse_str( $format_query, $format_args );
        
                // Find the query args of the requested URL.
                wp_parse_str( $url_parts[1], $url_query_args );
        
                // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
                foreach ( $format_args as $format_arg => $format_arg_value ) {
                    unset( $url_query_args[ $format_arg ] );
                }
                $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
            }

            $add_args = $args['add_args'];
            $link_prev = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
            $link_prev = str_replace( '%#%', $current - 1, $link_prev );
            $link_next = str_replace( '%_%', $args['format'], $args['base'] );
            $link_next = str_replace( '%#%', $current + 1, $link_next );

            if ( $add_args ) {
                $link_prev = add_query_arg( $add_args, $link_prev );
                $link_next = add_query_arg( $add_args, $link_next );
            }
            $link_prev .= $args['add_fragment'];
            $link_next .= $args['add_fragment'];
            
            $fox_pageOut  = "<nav class='custom-pagination flex'>";

            if ( $args['current'] == $args['total'] ) {

                if ( $args['current'] >= 2 && $args['current'] < $args['total'] || $args['current'] == $args['total'] && $args['total'] > 2 ) {

                    $prev = '<a href="'.esc_url( $link_prev ).'">'.$args['prev_text'].'</a>';
                    
                } else {

                    $prev = '<span class="disable">'.$args['prev_text'].'</span>';

                }

                $next = '<span class="disable">'.$args['next_text'].'</span>';
                
            } elseif ( $args['current'] < $args['total'] ) {

                if ( $args['current'] >= 2 && $args['current'] < $args['total'] ) {

                    $prev = '<a href="'.esc_url( $link_prev ).'">'.$args['prev_text'].'</a>';


                } elseif ( $args['current'] < $args['total']  ) {

                    $prev = '<span class="disable">'.$args['prev_text'].'</span>';

                } else {
                    
                    $prev = '<a href="'.esc_url( $link_prev ).'">'.$args['prev_text'].'</a>';

                }
                $next = '<a href="'.esc_url( $link_next ).'">'.$args['next_text'].'</a>';


            } else {
                
                if ( $args['current'] == $args['total'] ) {
                    $prev = '<span class="disable">'.$args['prev_text'].'</span>';
                    $next = '<a href="'.esc_url( $link_next ).'">'.$args['next_text'].'</a>';
                } else {
                    $prev = '<a href="'.esc_url( $link_prev ).'">'.$args['prev_text'].'</a>';
                    $next = '<a href="'.esc_url( $link_next ).'">'.$args['next_text'].'</a>';
                }
                
            }

            $fox_pageOut .= $prev;
            $fox_pageOut .= '<span class="count-paged">( Page '.$paged.' )</span>';
            $fox_pageOut .= $next;
                
            $fox_pageOut .= "</nav>";

            return $fox_pageOut;
        }
    }
    
endif;
$pageds = new App_paged;