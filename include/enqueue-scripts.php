<?php
/**
 * File: kfp-clickcount/include/enqueue-scripts.php
 *
 * @package kfp_clickcount
 */

// Agrega el código JavaScript que estará vigilando nuestra web.
add_action( 'wp_enqueue_scripts', 'kfp_clickcount_enqueue_scripts' );
/**
 * Agrega el fichero JavaScript a la cola
 *
 * @return void
 */
function kfp_clickcount_enqueue_scripts() {
	wp_enqueue_script(
		'kfp-clickcount',
		plugins_url( 'js/clickcount.js', KFP_CLICKCOUNT_PLUGIN_FILE ),
		array( 'jquery' ),
		KFP_CLICKCOUNT_VERSION,
		true
	);
	wp_localize_script(
		'kfp-clickcount',
		'AjaxParams',
		array(
			'adminAjaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'        => wp_create_nonce( 'clickcount-nonce' ),
		)
	);
}
