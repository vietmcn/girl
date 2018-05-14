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
                __( 'Thuộc Tính Thumbnail' ),
                array( $this, 'mb_callback' ),
                'photo',
                'normal', 
                'default'
            );

        }
        public function mb_callback()
        {
            $field = new Set_Field;
            $field->Metabox_field( 
                'textbox',
                array( 'list' => array(
                    'meta_thumbnail',
                    'meta_pic'
                ) )
            );

        }
        public function metabox_save()
        {
            
        }
    }
}
return new Content_metabox;