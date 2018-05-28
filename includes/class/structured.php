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
        protected $att = array();

        public function meta( $att )
        {

        }
    }
}
$struct = new Ninja_Structured;