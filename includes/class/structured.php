<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
if (!class_exists( 'Ninja_Structured' ) ) {
    class Ninja_Structured
    {
        /**
         * Array
         */
        protected $atts = array();
        
        protected $att = NULL;
        
        private function facebook( $atts )
        {
            ?>
            <meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
            <meta property="og:type"               content="article" />
            <meta property="og:title"              content="When Great Minds Don’t Think Alike" />
            <meta property="og:description"        content="How much does culture influence creative thinking?" />
            <meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
            <?php
        }
        private function tw( $atts )
        {

        }
        private function pint( $atts )
        {

        }
        private function default( $atts )
        {

        }
        public function title( $att ) 
        {
            return '<title>'.$att.'</title';
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
$struct = new Ninja_Structured;