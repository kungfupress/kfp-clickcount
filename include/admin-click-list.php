<?php
/**
 * File: kfp-clickcount/include/admin-click-list.php
 *
 * @package KFP ClickCount
 */

defined( 'ABSPATH' ) || die();

add_action( 'admin_menu', 'kfp_clickcount_menu' );
/**
 * Agrega el menú del plugin al formulario de WordPress
 *
 * @return void
 */
function kfp_clickcount_menu() {
	add_menu_page(
		'Click Count',
		'Click Count',
		'manage_options',
		'kfp_clickcount_menu',
		'kfp_clickcount_admin',
		'dashicons-feedback',
		75
	);
}

/**
 * Pinta la tabla con los enlaces registrados y sus contadores
 *
 * @return void
 */
function kfp_clickcount_admin() {
	global $wpdb;
	$tabla_clickcounts = $wpdb->prefix . 'kfp_clickcount';
	$clickcounts = $wpdb->get_results( "SELECT * FROM $tabla_clickcounts" );
	echo '<div class="wrap"><h1>Lista de Enlaces</h1>';
	echo '<table class="wp-list-table widefat fixed striped">';
	echo '<thead><tr><th>Enlaces</th><th>Clicks</th>';
	echo '</tr></thead>';
	echo '<tbody id="the-list">';
	foreach ( $clickcounts as $clickcount ) {
		echo '<td>' . esc_textarea( $clickcount->link ) . '</td>';
		echo '<td>' . (int) $clickcount->clicks . '</td></tr>';
	}
	echo '</tbody></table></div>';
}
