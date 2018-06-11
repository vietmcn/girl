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
import_commp( 'struct' );
//Header
import_commp( 'header' );
//Side bar 
import_commp( 'sidebar' );
//Page Content
import_commp( 'content-front' );
//Page Archive 
import_commp( 'content-archive' );
//Page Tag 
import_commp( 'content-tag' );
//Page Download
import_commp( 'content-download' );
//single
import_commp( 'content-single' );
//Footer
import_commp( 'footer' );
//404
import_commp( '404' );
//Filter 
import_commp( 'filter' );