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
            $out  = '<meta name="description" content="'.esc_attr( $atts['desc'] ).'"/>';
            $out .= '<meta property="og:type" content="'.esc_attr( $atts['web_type'] ).'" />';
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
        public function logo( $atts )
        {
            return json_encode( [
                "@context" => "http://schema.org",
                "@type" => "Organization",
                "url" => esc_url( $atts['url'] ),
                "logo" => esc_url( $atts['logo'] ),
            ] );
        }
        public function breadcrumb( $atts ) 
        {
            return json_encode( [
                '@context' => esc_url( 'http://schema.org' ),
                '@type' => 'BreadcrumbList',
                'itemListElement' => [ [ 
                    '@type' => 'ListItem',
                    'position' => 1,
                    'item' => [
                        '@id' => $atts['id_1']['id'],
                        'name' => $atts['id_1']['name'],
                        'image' => $atts['id_1']['image'],
                    ],
                ], [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'item' => [
                        '@id' => $atts['id_2']['id'],
                        'name' => $atts['id_2']['name'],
                        'image' => $atts['id_2']['image'],
                    ],
                ] ],
            ] );
        }
        public function single_post( $atts )
        {
            return json_encode( [
                "@context" => "http://schema.org",
                "@type" => "NewsArticle",
                "mainEntityOfPage" => [
                    "@type" => "WebPage",
                    "@id" => esc_url( $atts['url'] )
                ],
                "headline" => esc_attr( $atts['title'] ),
                "image" => [
                    $atts['image'],
                ],
                "datePublished" => $atts['public_date'],
                "dateModified" => $atts['public_date_mod'],
                "author" => [
                    "@type" => "Person",
                    "name" => $atts['author'],
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => $atts['public_name'],
                    "logo" => [
                    "@type" => "ImageObject",
                    "url" => $atts['logo'],
                    ]
                ],
                "description" => esc_attr( $atts['logo'] )
            ] );
        }
        
    }
}

$struct = new Ninja_Structured;