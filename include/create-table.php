<?php
/**
 * File: kfp-click-count/include/create-table.php
 *
 * @package KFP ClickCount
 */

defined( 'ABSPATH' ) || die();
/**
 * Crea las tablas necesarias durante la activación del plugin
 *
 * @return void
 */
function kfp_clickcount_create_table() {
	global $wpdb;
	$sql             = array();
	$table           = $wpdb->prefix . 'kfp_clickcount';
	$charset_collate = $wpdb->get_charset_collate();
	// Consulta para crear las tablas
	// Mas adelante utiliza dbDelta, si la tabla ya existe no la crea sino que la
	// modifica con los posibles cambios y sin pérdida de datos.
	$sql[] = "CREATE TABLE $table (
		id mediumint(9) UNSIGNED NOT NULL AUTO_INCREMENT,
		link varchar(250) NOT NULL UNIQUE,
		clicks int(11) UNSIGNED,
		date_first_click datetime,
		date_last_click datetime,
		PRIMARY KEY (id)
		) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}
