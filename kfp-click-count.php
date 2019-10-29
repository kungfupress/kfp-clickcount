<?php
/**
 * Plugin Name:   KFP Click Count
 * Plugin Author: KungFuPress
 * Description:   Cuenta los clicks en enlaces o botones de tu web
 * Plugin URI:    https://github.com/kungfupress/kfp-clickcount
 * Version:       0.1.1
 * Author:        Juanan Ruiz
 * Author URI:    https://kungfupress.com/
 *
 * @package KFP ClickCount
 */

defined( 'ABSPATH' ) || die();
$ruta_plugin = plugin_dir_path( __FILE__ );

// Crea la tabla para los enlaces al activar el plugin.
require_once $ruta_plugin . 'include/create-table.php';
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
		'1.0.0',
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
require_once $ruta_plugin . 'include/procesa-click.php';

// Shortcodes para mostrar la lista de clicks en escritorio o en la web.
require_once $ruta_plugin . 'include/admin-click-list.php';
require_once $ruta_plugin . 'include/public-click-list.php';
