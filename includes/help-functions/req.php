<?php 
if( !defined('ABSPATH') ) {
    exit;
}
/**
 * Import Template 
 * @since 1.0
 * @author Trangfox
 */
//Title
import_template( 'title' );
//Header
import_template( 'header' );
//Page Content
import_template( 'content-front' );
//Page Archive 
import_template( 'content-archive' );
//Page Tag 
import_template( 'content-tag' );
//Page Download
import_template( 'content-download' );
//single
import_template( 'content-single' );
//Footer
import_template( 'footer' );
//404
import_template( '404' );