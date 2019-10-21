<?php
/**
 * File: kfp-clickcount/include/procesa-click.php
 * Añade un action hook para capturar las llamadas ajax que utilicen este hook
 *
 * @package KFP ClickCount
 */

defined( 'ABSPATH' ) || die();
// Para usuarios autenticados.
add_action( 'wp_ajax_kfp-click-link', 'kfp_clickcount_procesa_click' );
// Para usuarios NO autenticados.
add_action( 'wp_ajax_nopriv_kfp-click-link', 'kfp_clickcount_procesa_click' );
/**
 * Busca si el link que le llega está dado de alta en la tabla kfp_click_count
 * Crea un nuevo registro con contador = 1 o incrementa el contador si el
 * registro ya existía.
 *
 * @return void
 */
function kfp_clickcount_procesa_click() {
	global $wpdb;
	$clickcount_table = $wpdb->prefix . 'kfp_clickcount';
	//check_ajax_referer( 'clickcount-nonce', 'nonce' );
	$link = esc_url_raw( $_POST['link'] );
	$row = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT id, clicks FROM `$clickcount_table` WHERE `link` = %s",
			$link
		)
	);

	// Si el link está en la tabla incrementa contador, y si no agrégalo.
	if ( null !== $row ) {
		$id = $row->id;
		$clicks = $row->clicks ++;
		$data = array( 'clicks' => $clicks );
		$where = array( 'id' => $id );
		$wpdb->update( $clickcount_table, $data, $where );
	} else {
		$wpdb->insert(
			$clickcount_table,
			array(
				'link'             => $link,
				'clicks'           => 1,
				'date_first_click' => date( 'Y-m-d' ),
			)
		);
	}
	echo esc_url_raw( $link );
	wp_die(); // imprescindible en ajax.
}
