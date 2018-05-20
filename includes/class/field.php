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

        public function Metabox_field( $att )
        {
            switch ( $att['type'] ) {
                case 'textbox':
                    $this->textbox( $att['post_id'], $att['content'], $att['keyname'] );
                    break;
            }
        }
        private function textbox( $post_id, $att, $keyname )
        {
            $meta = get_post_meta( $post_id, $keyname, true );
            
            foreach ( $att as $key => $value ) {
                if ( ! empty( $meta ) ) {
                    $val = $meta[$value];
                } else {
                    $val = '';
                }
                switch ( $key ) {
                    case 'id_1' :
                        $out  = '<label for ="'.$value.'" class="">Thumbnail</label>';
                        $out .= '<input class="'.$value.'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value.']' ).'" value="'.$val.'" />';
                        echo $out;
                        break;
                    case 'id_2' :
                        $out  = '<label for ="'.$value.'" class="">Count Pic</label>';
                        $out .= '<input class="'.$value.'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value.']' ).'" value="'.$val.'" />';
                        echo $out;
                        break;
                }
            }
        }
    }
    
}