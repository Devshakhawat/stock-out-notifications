<?php
namespace Wpcommerz;

class Installer {

    /**
     * Class construct
     *
     * @since 1.0.0
     */
    public function run() {
        $this->create_table();       
     }

     /**
      * create db tables
      *
      * @since 1.0.0
      */
     public function create_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE if not exists
        `{$wpdb->prefix}customer_email`(
        `id` INT(20) NOT NULL AUTO_INCREMENT,
        `email` VARCHAR(30),        
        PRIMARY KEY(`id`) )
        $charset_collate";
         
        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
     } 
}