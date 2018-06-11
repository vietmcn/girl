<?php 
if (!defined( 'ABSPATH' ) ) {
    exit;
}
if ( !function_exists( 'ninja_filter_header' ) ) {
    function ninja_filter_header()
    {
        $out  = '<aside ninja-filter class="filter">';
        $out .= '<div class="header-title flex">';
        $out .= '<h3>Browse Available Gallery</h3>';
        $out .= '</div>';
        $out .= '<div class="filter-bottom">';
        $out .= '</div>';
        $out .= '</aside>';
        return $out;
    }
}