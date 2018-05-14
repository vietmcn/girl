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

        public function Metabox_field( $type, $att )
        {
            
            switch ( $type ) {
                case 'textbox':
                    $this->textbox( $att );
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        private function textbox( $att )
        {
            foreach ( $att as  $atts ) {
                echo $atts[0];
            }
        }
    }
    
}