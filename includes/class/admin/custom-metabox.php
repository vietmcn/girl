<?php
if ( !defined('ABSPATH') ) {
    exit;
}
//import field
require_once ( N_EXTEND_FOLDER .'/includes/class/field.php' );

/**
 * Custom Meta Box 
 * @link {https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/}
 * @since 1.0
 * @author Trangfox
 */
if ( !class_exists('Content_metabox') ) {
    class Content_metabox
    {
        public function __construct()
        {
            add_action( 'add_meta_boxes',        array( $this, 'metabox_add'  ) );
            add_action( 'save_post',             array( $this, 'metabox_save'  ) );
        }
        public function metabox_add()
        {
            /**
             * add_meta_boxes
             * @link {https://developer.wordpress.org/reference/functions/add_meta_box/}
             * @since 1.0
             * @author Trangfox
             */
            add_meta_box(
                '_meta_thumbnail',
                __( 'Thuộc Tính' ),
                array( $this, 'mb_callback' ),
                'photo',
                'normal', 
                'default'
            );
        }
        public function mb_callback( $post )
        {
            wp_nonce_field( 'car_nonce_action', 'car_nonce' );

            $field = new Set_Field;
            
            $field->Metabox_field( array(
                'type' => 'textbox',
                'keyname' => '_meta_thumbnail',
                'post_id' => $post->ID,
                'content' => array(
                    'id_1' => 'meta_thumbnail',
                    'id_2' => 'meta_count',
                ),
            ) );
        }
        public function metabox_save( $post_id )
        {
            // Save logic goes here. Don't forget to include nonce checks!
            $nonce_name   =  isset( $_POST['car_nonce'] ) ? $_POST['car_nonce'] : '';
        
            $nonce_action = 'car_nonce_action';
            // Check if a nonce is set.
            if ( ! isset( $nonce_name ) )
               return;
        
            // Check if a nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
                return $post_id;

            // check autosave
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
                return $post_id;

            // check permissions
            if ( 'page' == $_POST['post_type'] ) {

                if (!current_user_can('edit_page', $post_id)) 

                    return $post_id;

            } elseif (! current_user_can('edit_post', $post_id) ) {

                return $post_id;

            }
            // loop through fields and save the data
            

                $old = get_post_meta( $post_id, '_meta_thumbnail', false );

                $new = $_POST['_meta_thumbnail'];

                if ( $new && $new != $old ) {

                    update_post_meta( $post_id, '_meta_thumbnail', $new );

                } elseif ( '' == $new ) {

                    delete_post_meta( $post_id, '_meta_thumbnail' );

                }
        }
    }
}
return new Content_metabox;