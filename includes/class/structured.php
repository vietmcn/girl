<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;

if ( ! class_exists( 'Ninja_Structured' ) ) {
    class Ninja_Structured
    {
        /**
         * Array
         */
        protected $atts = array();

        public function info( $atts )
        {
            $out  = '<meta property="og:type" content="'.esc_attr( $atts['web_type'] ).'" />';
            $out .= '<meta property="og:title" content="'.esc_attr( $atts['title'] ).'" />';
            $out .= '<meta property="og:description" content="'.esc_attr( $atts['desc'] ).'" />';
            $out .= '<meta property="og:url" content="'.esc_attr( $atts['url'] ).'" />';
            $out .= '<meta property="og:image" content="'.esc_attr( $atts['image'] ).'" />';
            return $out;
        }
        public function default( $atts )
        {  
            $out  = '<meta property="og:locale" content="'.esc_attr( $atts['locale'] ).'" />';
            $out .= '<meta property="og:site_name" content="'.esc_attr( $atts['site_name'] ).'" />';
            $out .= '<meta property="fb:app_id" content="'.esc_attr( $atts['fb_id'] ).'" />';
            $out .= '<meta name="twitter:card" content="'.esc_attr( $atts['card'] ).'" />';
            $out .= '<meta name="twitter:site" content="@'.esc_attr( $atts['site_name'] ).'" />';
            $out .= '<meta name="twitter:creator" content="@'.esc_attr( $atts['creator'] ).'" />';
            return $out;
        }
        public function single( $atts )
        {
            $out  = '<meta property="article:published_time" content="'.$atts['public_time'].'" />';
            $out .= '<meta property="article:section" content="'.esc_attr( $atts['cat'] ).'"/>';
            $out .= '<meta property="article:tag" content="'.esc_attr( $atts['tag'] ).'"/>';
            $out .= '<meta property="article:author" content="'.esc_attr( $atts['author'] ).'" />';
            return $out;
        }
    }
}

$struct = new Ninja_Structured;