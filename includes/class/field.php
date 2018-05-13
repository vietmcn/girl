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

        public function field( $att )
        {
            $atts = $att['value'];

            switch ( $att['type'] ) {
                case 'textbox':
                    $this->textbox( $atts );
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        private function textbox( $att )
        {
            $out  = '<lable class="">'.$att['title'].'</label>';
            $out .= '<input id="" value="'.$att['value']['val'].'" class=""/>';
        }
    }
    
}