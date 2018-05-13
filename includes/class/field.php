<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
/**
 * Khởi Tạo Field
 * @since 1.0
 * @author Trangfox
 */
if ( !class_exists('Set_Field') ) {
    class Set_Field
    {
        protected $att = array();
        private function textbox( $att )
        {

        }
        public function field( $att )
        {
            switch ( $att['type'] ) {
                case 'textbox':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
    
}