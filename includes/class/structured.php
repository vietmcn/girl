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

        public function title( $att ) 
        {
            return '<title>'.$att.'</title';
        }
        public function meta( $atts )
        {

        }
    }
}
$struct = new Ninja_Structured;