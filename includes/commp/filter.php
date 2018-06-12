<?php 
if (!defined( 'ABSPATH' ) ) {
    exit;
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
            $out .= '<a href="/" class="active">All Photo</a>';
            $out .= '<a href="#">Most Recent</a>';
            $out .= '<a href="#">Most Popular</a>';
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