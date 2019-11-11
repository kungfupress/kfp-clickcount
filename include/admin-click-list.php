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

	$html  = '<div class="wrap">';
	$html .= '<h1>' . esc_html__( 'Links List', 'kfp-clickcount' ) . '</h1>';
	$html .= '<table class="wp-list-table widefat fixed striped">';
	$html .= '<thead><tr>';
	$html .= '<th width="50%">' . esc_html__( 'Link', 'kfp-clickcount' ) . '</th>';
	$html .= '<th width="10%">' . esc_html__( 'Clicks', 'kfp-clickcount' ) . '</th>';
	$html .= '<th width="20%">' . esc_html__( 'First Click', 'kfp-clickcount' ) . '</th>';
	$html .= '<th width="20%">' . esc_html__( 'Last Click', 'kfp-clickcount' ) . '</th>';
	$html .= '</tr></thead>';
	$html .= '<tbody id="the-list">';
	foreach ( $clickcounts as $clickcount ) {
		$html .= '<tr>';
		$html .= '<td><a href="' . esc_url_raw( $clickcount->link ) . '">';
		$html .= esc_textarea( $clickcount->link ) . '</a></td>';
		$html .= '<td>' . (int) $clickcount->clicks . '</td>';
		$html .= '<td>' . esc_textarea( $clickcount->date_first_click ) . '</td>';
		$html .= '<td width="20%">' . esc_textarea( $clickcount->date_last_click ) . '</td>';
		$html .= '</tr>';
	}
	$html .= '</tbody></table></div>';
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $html;
}
