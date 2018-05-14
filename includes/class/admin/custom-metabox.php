<?php
if ( !defined('ABSPATH') ) {
    exit;
}
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

        }
        public function metabox_save()
        {
            
        }
    }
}