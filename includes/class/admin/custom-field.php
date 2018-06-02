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
            switch ( !empty( $att['type'] ) ) {
                case 'textarea':
                    $this->textarea( $att['post_id'], $att['content'], $att['keyname'] );
                    break;
                default :
                    $this->textbox( $att['post_id'], $att['content'], $att['keyname'] );
                    break;
            }
        }
        private function textarea( $post_id, $att, $keyname )
        {
            $meta = get_post_meta( $post_id, $keyname, true );
            foreach ($att as $key => $value) {
                $val = ( !empty( $meta[$value['value'] ] ) ) ? $meta[$value['value']] : '';
                $out = '<label style="display:block" for="'.$value['title'].'"><strong>'.$value['title'].'</strong>';
                if ( !empty( $value['desc'] ) ) {
                    $out .= '<br /><span>'.$value['desc'].'</span>';
                }
                $out .= '</label>';
                $out .= '<textarea cols="40" rows="1" style="display:block;width:100%;min-height:120px" name="'.esc_attr( $keyname.'['.$value['value'].']' ).'">'.$val.'</textarea>';
            }
            echo $out;
        }
        private function textbox( $post_id, $att, $keyname )
        {
            $meta = get_post_meta( $post_id, $keyname, true );
            $i = 0;
            foreach ( $att as $key => $value ) {
                if ( !empty( $value['type'] ) == 'multi' ) {
                    $multi = '[0]';
                    $out .= '<span id="add-address" class="button_plus">+</span>';
                } else {
                    $multi = '';
                }
                //Render
                $out  = '<label for ="'.$value['title'].'" class=""><strong>'.$value['title'].'</strong></label>';
                if ( !empty( $value['desc'] ) ) {
                    $out .= '<strong>'.$value['desc'].'</strong>';
                }
                
                if ( empty( $meta ) ) {

                    $out .= '<input class="'.$value['title'].'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value['value'].']'.$multi ).'" value="" />';
                
                } else {

                    /**
                     * Check Multiple Input
                     * @since 1.0
                     * @author ninjafox
                     */
                    $val = ( !empty( $meta[$value['value'] ] ) ) ? $meta[$value['value']] : '';
                    
                    if ( !empty( $value['type'] ) == 'multi' ) {
                        foreach ($val as  $values) {
                            $out .= '<div class="address">';
                            $out .= '<input style="margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value['value'].']['.$i++.']' ).'" value="'.$values.'" />';
                            $out .= '<span class="remove-address button_plus">-</span>';
                            $out .= '</div>';   
                        }
                    } else {
                        $out .= '<input class="'.$value['title'].'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value['value'].']' ).'" value="'.$val.'" />';
                    }
                }
                echo $out;
            }
        }
    }
    
}