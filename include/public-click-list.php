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

	$html  = '<table class="wp-list-table widefat fixed striped">';
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
	$html .= '</tbody></table>';

	return $html;
}
