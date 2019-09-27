<?php
/** 
 * File: include/create-table.php 
 */
defined( 'ABSPATH' ) or die();

/**
 * Crea las tablas necesarias durante la activación del plugin
 *
 * @return void
 */
function kfp_clickcount_create_table()
{
    global $wpdb;
    $sql = array();
    $clickcount_table = $wpdb->prefix . 'kfp_clickcount';
    $charset_collate = $wpdb->get_charset_collate();
    
    // Consulta para crear las tablas
    // Mas adelante utiliza dbDelta, si la tabla ya existe no la crea sino que la
    // modifica con los posibles cambios y sin pérdida de datos
    $sql[] = "CREATE TABLE $clickcount_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        link varchar(500) NOT NULL UNIQUE,
        clicks bigint(20),
        date_first_click date,
        PRIMARY KEY (id)
        ) $charset_collate";
    
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}