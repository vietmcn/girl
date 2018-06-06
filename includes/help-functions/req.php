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
//Import SEO
#import_template( 'seo' );
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