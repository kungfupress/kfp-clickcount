<?php
/**
 * Plugin Name: KFP Click Count
 * Plugin Author: KungFuPress
 * Description: Cuenta los clicks en enlaces o botones de tu web
 */

defined( 'ABSPATH' ) or die();
$ruta_plugin = plugin_dir_path(__FILE__);

// Crea la tabla para los enlaces al activar el plugin
include_once($ruta_plugin . "include/create-table.php");
register_activation_hook(__FILE__, 'kfp_clickcount_create_table');

// Agrega el script que estará vigilando nuestra web
add_action( 'wp_enqueue_scripts', 'kfp_clickcount_enqueue_scripts' );
function kfp_clickcount_enqueue_scripts()
{
  wp_enqueue_script('kfp-clickcount', plugins_url('js/clickcount.js', __FILE__), array('jquery'), '1.0.0', true );
  wp_localize_script( 'kfp-clickcount', 'AjaxParams', array(
    'adminAjaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('clickcount-nonce')
    ));
}

// Procesa la pulsación de un enlace mediante AJAX
include_once($ruta_plugin . "include/procesa-click.php");

// Shortcodes para mostrar la lista de clicks en escritorio o en la web
include_once($ruta_plugin . "include/admin-click-list.php");
include_once($ruta_plugin . "include/public-click-list.php");