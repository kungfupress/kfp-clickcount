<?php
/**
 * Plugin Name:   KFP ClickCount
 * Plugin Author: KungFuPress
 * Description:   Cuenta los clicks en enlaces o botones de tu web
 * Plugin URI:    https://github.com/kungfupress/kfp-clickcount
 * Version:       0.1.3
 * Author:        Juanan Ruiz
 * Author URI:    https://kungfupress.com/
 *
 * @package kfp_clickcount
 */

defined( 'ABSPATH' ) || die();
define( 'KFP_CLICKCOUNT_DIR', plugin_dir_path( __FILE__ ) );
define( 'KFP_CLICKCOUNT_VERSION', '0.1.3' );


// Crea la tabla para los enlaces al activar el plugin.
require_once KFP_CLICKCOUNT_DIR . 'include/create-table.php';
register_activation_hook( __FILE__, 'kfp_clickcount_create_table' );

// Agrega el script que estará vigilando nuestra web.
add_action( 'wp_enqueue_scripts', 'kfp_clickcount_enqueue_scripts' );
/**
 * Agrega el fichero javascript a la cola
 *
 * @return void
 */
function kfp_clickcount_enqueue_scripts() {
	wp_enqueue_script(
		'kfp-clickcount',
		plugins_url( 'js/clickcount.js', __FILE__ ),
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

// Procesa la pulsación de un enlace mediante AJAX.
require_once KFP_CLICKCOUNT_DIR . 'include/procesa-click.php';

// Shortcodes para mostrar la lista de clicks en escritorio o en la web.
require_once KFP_CLICKCOUNT_DIR . 'include/admin-click-list.php';
require_once KFP_CLICKCOUNT_DIR . 'include/public-click-list.php';
