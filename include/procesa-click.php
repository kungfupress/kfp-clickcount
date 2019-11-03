<?php
/**
 * File: kfp-clickcount/include/procesa-click.php
 * Añade un action hook para capturar las llamadas ajax que utilicen este hook.
 *
 * @package KFP ClickCount
 */

defined( 'ABSPATH' ) || die();
// Para usuarios autenticados.
add_action( 'wp_ajax_kfp-clickcount-link', 'kfp_clickcount_procesa_click' );
// Para usuarios NO autenticados.
add_action( 'wp_ajax_nopriv_kfp-clickcount-link', 'kfp_clickcount_procesa_click' );
/**
 * Busca si el link que le llega está dado de alta en la tabla kfp_click_count
 * Crea un nuevo registro con contador = 1 o incrementa el contador si el
 * registro ya existía.
 *
 * @return void
 */
function kfp_clickcount_procesa_click() {
	global $wpdb;
	$table = $wpdb->prefix . 'kfp_clickcount';
	// phpcs:ignore WordPress.Security.NonceVerification
	if ( ! isset( $_POST['link'] ) ) {
		die();
	}
	// phpcs:ignore WordPress.Security.NonceVerification
	$link = esc_url_raw( wp_unslash( $_POST['link'] ) );
	// Muy importantes los acentos graves en el nombre de la tabla !
	// Igual de importante que no poner comillas a los nombres de campo !
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$row = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT id, clicks FROM `{$wpdb->prefix}kfp_clickcount` 
				WHERE link = %s",
			array( $link )
		)
	);
	// Si el link está en la tabla incrementa contador, y si no agrégalo.
	if ( $row ) {
		$id     = $row->id;
		$clicks = $row->clicks + 1;
		$data   = array(
			'clicks'          => $clicks,
			'date_last_click' => date( 'Y-m-d H:i:s' ),
		); // actualiza esto.
		$where  = array( 'id' => $id ); // cuando se cumpla esto.
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$wpdb->update( $table, $data, $where );
	} else {
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$wpdb->insert(
			$table,
			array(
				'link'             => $link,
				'clicks'           => 1,
				'date_first_click' => date( 'Y-m-d H:i:s' ),
				'date_last_click'  => date( 'Y-m-d H:i:s' ),
			)
		);
	}
	echo esc_url_raw( $link );
	wp_die(); // imprescindible en ajax.
}
