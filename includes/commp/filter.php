<?php 
if (!defined( 'ABSPATH' ) ) {
    exit;
}
function ninja_filter_header_menu()
{   
    global $custom_menu;

    $out = $custom_menu->menu([
        'name' => 'ALL Photo',
        'link' => get_bloginfo('url').'/',
    ]);
    $out .= $custom_menu->menu([
        'name' => 'Most View',
        'query' => 'view=desc',
        'link' => './?view=desc',
    ]);
    return $out;
}
if ( !function_exists( 'ninja_filter_header' ) ) {
    function ninja_filter_header( $att = array() )
    {
        global $mobile;
        if ( $mobile->isTablet() || ! $mobile->isMobile() ) {

            $out  = '<aside ninja-filter class="filter">';
            $out .= '<div class="header-title flex">';
            $out .= '<h3>Browse Available Gallery</h3>';
            $out .= '</div>';
            $out .= '<div class="filter-bottom flex">';
            $out .= '<div class="filter-button">';
            $out .= ninja_filter_header_menu();
            $out .= '</div>';
            $out .= '<div class="filter-search">';
            $out .= '<gcse:search></gcse:search>';
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</aside>';
            return $out;
            
        }
    }
}
add_action( 'wp_footer', function() {
    global $mobile;
    if ( $mobile->isTablet() || ! $mobile->isMobile() ) {
        ?>
            <script>
                (function() {
                    var cx = '004572981609386711469:jqr1ea4zhx4';
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;
                    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                })();
            </script>
        <?php 
    }
} );