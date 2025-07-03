<?php
/**
 * File Reader Factory
 * 
 * @package Eventin
 */
namespace Eventin\Importer;

class ReaderFactory {
    /**
     * Get reader depends on file type
     *
     * @return Reader_Interface
     */
    public static function get_reader( $file ) {
        $file_name  = ! empty( $file['tmp_name'] ) ? $file['tmp_name'] : '';
        $file_type  = ! empty( $file['type'] ) ? $file['type'] : '';


        switch( $file_type ) {
            case 'application/json':
                return new JSONReader( $file_name );
            case 'text/csv':
                return new CSVReader( $file_name );
            default:
                throw new \Exception( __( 'You must provide a valid file type', 'eventin' ) );
        }
    }
}
