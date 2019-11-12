<?php
/**
 * Plugin Name:   KFP ClickCount
 * Description:   Cuenta los clics en enlaces o botones de tu web
 * Plugin URI:    https://github.com/kungfupress/kfp-clickcount
 * Version:       1.1.0
 * Text Domain:   kfp-clickcount
 * Domain Path: /languages
 * Plugin Author: Juanan Ruiz
 * Author URI:    https://kungfupress.com/
 *
 * @package kfp_clickcount
 */

defined( 'ABSPATH' ) || die();

define( 'KFP_CLICKCOUNT_DIR', plugin_dir_path( __FILE__ ) );
define( 'KFP_CLICKCOUNT_PLUGIN_FILE', __FILE__ );
define( 'KFP_CLICKCOUNT_VERSION', '1.1.0' );

// Inicializa el plugin.
require_once KFP_CLICKCOUNT_DIR . 'include/plugin-init.php';
// Crea la tabla para los enlaces al activar el plugin.
require_once KFP_CLICKCOUNT_DIR . 'include/create-table.php';
// Llama al fichero JavaScript que estará vigilando la pulsación de enlaces.
require_once KFP_CLICKCOUNT_DIR . 'include/enqueue-scripts.php';
// Procesa la pulsación de un enlace mediante AJAX.
require_once KFP_CLICKCOUNT_DIR . 'include/procesa-click.php';
// Panel administrativo para ver el contenido de la tabla en el escritorio.
require_once KFP_CLICKCOUNT_DIR . 'include/admin-click-list.php';
// Shortcode para mostrar la lista de clics en escritorio o en la web.
require_once KFP_CLICKCOUNT_DIR . 'include/public-click-list.php';
