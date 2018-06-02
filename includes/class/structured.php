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
        
        protected $att = NULL;

        private function facebook( $atts )
        {
            /**
             * Object Facebook
             * @since 1.0
             * @author 
             */
            $out  = '<meta property="og:url" content="'.esc_url( $atts['url'] ).'" />';
            $out .= '<meta property="og:type" content="'.esc_attr( $atts['type'] ).'" />';
            $out .= '<meta property="og:title" content="'.esc_attr( $atts['title'] ).'" />';
            $out .= '<meta property="og:description" content="'.esc_attr( $atts['desc'] ).'" />';
            $out .= '<meta property="og:image" content="'.esc_url( $atts['image'] ).'" />';
            return $out;
        }
        private function tw( $atts )
        {

        }
        private function pint( $atts )
        {

        }
        private function default( $atts )
        {
            return '<meta property="fb:app_id" content="'.esc_attr( $atts['app_id'] ).'" />';
        }
        public function title( $att ) 
        {
            return '<title>'.$att.'</title>';
        }
        public function meta( $atts )
        {
            switch ( $atts['type'] ) {
                case 'facebook':
                    $out = $this->facebook( $atts['content'] );
                    break;
                case 'tw':
                    $out = $this->tw( $atts['content'] );
                    break;
                case 'pint':
                    $out = $this->pint( $atts['content'] );
                    break;
                default:
                    $out = $this->default( $atts['content'] );
                    break;
            }
            return $out;
        }
    }
}
