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
            $i = 0;
            foreach ( $att as $key => $value ) {
                $out  = '<label for ="'.$value['title'].'" class="">'.$value['title'].'</label>';
                if ( empty( $meta ) ) {
                    $out .= '<input class="'.$value['title'].'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value['value'].']' ).'" value="" />';
                } else {
                    $val = $meta[$value['value'] ];
                    $out .= '<input class="'.$value['title'].'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value['value'].']' ).'" value="'.$val.'" />';
                }
                echo $out;
            }
        }
    }
    
}
/**
 * switch ( $key ) {

                    case 'id_1' :
                        $out  = '<label for ="'.$value['title'].'" class="">Thumbnail</label>';
                        $out .= '<input class="'.$value['title'].'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value.']' ).'" value="'.$val.'" />';
                        echo $out;
                        break;
                    case 'id_2' :
                        $out  = '<label for ="'.$value.'" class="">Count Pic</label>';
                        $out .= '<input class="'.$value.'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value.']' ).'" value="'.$val.'" />';
                        echo $out;
                        break;
                    case 'id_3':
                        $out  = '<label for ="'.$value.'" class="">File Size</label>';
                        $out .= '<input class="'.$value.'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value.']' ).'" value="'.$val.'" />';
                        echo $out;
                        break;
                    case 'id_4':
                        $out   = '<div class="Meta_item meta_label">';
                        $out  .= '<label for ="'.$value.'" class="">Link Download</label>';
                        $out .= '<span id="add-address" class="button_plus">+</span>';
                        
                        if ( empty( $meta[$value] ) == 'meta_download' ) {
                            
                            $out .= '<input style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'['.$value.'][0]' ).'" value="'.$val.'" />';

                        } else {
                            foreach ( $meta[$value] as $key => $value ) {
                                
                                $out .= '<div class="address">';
                                $out .= '<input style="margin: 5px 0px;" type="text" name="'.esc_attr( $keyname.'[meta_download]['.$i++.']' ).'" value="'.$value.'" />';
                                $out .= '<span class="remove-address button_plus">-</span>';
                                $out .= '</div>';
                            }
                        }
                        $out .= '</div>';
                        echo $out;
                        break;
                    
                }
 */