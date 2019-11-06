<?php
/**
 * File: kfp-clickcount/include/admin-click-list.php
 *
 * @package kfp_clickcount
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
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$clickcounts = $wpdb->get_results(
		"SELECT * FROM {$wpdb->prefix}kfp_clickcount"
	);
	echo '<div class="wrap"><h1>Lista de Enlaces</h1>';
	echo '<table class="wp-list-table widefat fixed striped">';
	echo '<thead><tr><th width="50%">Enlaces</th><th width="10%">Clics</th>
		<th width="20%">Primer Clic</th><th width="20%">Último Clic</th>';
	echo '</tr></thead>';
	echo '<tbody id="the-list">';
	foreach ( $clickcounts as $clickcount ) {
		echo '<tr>';
		echo '<td><a href="' . esc_url_raw( $clickcount->link ) . '">'
			. esc_textarea( $clickcount->link ) . '</a></td>';
		echo '<td>' . (int) $clickcount->clicks . '</td>';
		echo '<td>' . esc_textarea( $clickcount->date_first_click ) . '</td>';
		echo '<td width="20%">' . esc_textarea( $clickcount->date_last_click ) . '</td>';
		echo '</tr>';
	}
	echo '</tbody></table></div>';
}
