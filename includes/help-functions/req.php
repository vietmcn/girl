<?php 
if( !defined('ABSPATH') ) {
    exit;
}
/**
 * Import Template 
 * @since 1.0
 * @author Trangfox
 */
//Header
import_template( 'header' );
//Page Content
import_template( 'content' );
//Page Archive 
import_template( 'content-archive' );
//Page Download
import_template( 'content-download' );
//single
import_template( 'content-single' );
//Footer
import_template( 'footer' );