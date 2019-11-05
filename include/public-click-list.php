<?php
/**
 * File: kfp-clickcount/include/public-click-list.php
 *
 * @package kfp_clickcount
 */

defined( 'ABSPATH' ) || die();

add_shortcode( 'kfp-clickcount-public-list', 'kfp_clickcount_public_list' );
/**
 * Muestra la lista de enlaces con los contadores en el fronted
 *
 * @return string
 */
function kfp_clickcount_public_list() {
	global $wpdb;
	$html = '';
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$clickcounts = $wpdb->get_results(
		"SELECT * FROM {$wpdb->prefix}kfp_clickcount"
	);

	$html .= '<div class="wrap"><h1>Lista de Enlaces</h1>';
	$html .= '<table class="wp-list-table widefat fixed striped id="clickcount-report">';
	$html .= '<thead><tr><th>Enlaces</th><th>Clicks</th>';
	$html .= '<th>Primer Click</th><th>Último Click</th>';
	$html .= '</tr></thead>';
	$html .= '<tbody id="the-list">';

	foreach ( $clickcounts as $clickcount ) {
		$html .= '<tr>';
		$html .= '<td><a href="' . esc_url_raw( $clickcount->link ) . '">';
		$html .= esc_textarea( $clickcount->link ) . '</a></td>';
		$html .= '<td>' . (int) $clickcount->clicks . '</td>';
		$html .= '<td>' . esc_textarea( $clickcount->date_first_click ) . '</td>';
		$html .= '<td>' . esc_textarea( $clickcount->date_last_click ) . '</td>';
		$html .= '</tr>';
	}
	$html .= '</tbody></table></div>';

	return $html;
}
